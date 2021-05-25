<?php

/**
 * Ticket Controller
 * Jovic
 * 2021-04-19
 */

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Services\DinstarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ExportExcel;

use StdClass;
use App\Models\Project;
use App\Models\User;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $tickets = Ticket::with(['project','assignedTo'])->where('project_id', $request->projectId);
        if ($request->unassigned == Ticket::ASSIGNED) {
            $tickets = $tickets->where('status', Ticket::UNASSIGNED);
        }
        if ($request->open == Ticket::ASSIGNED) {
            $tickets = $tickets->where('assigned_to', $request->userId)->open();
        }
        if ($request->closed == Ticket::ASSIGNED) {
            $tickets = $tickets->where('assigned_to', $request->userId)->closed();
        }

        $tickets = $tickets->paginate(Ticket::PER_PAGE);

        $response = new StdClass();

        $response->headers = [
            (object) ['text' => 'Mobile', 'align' => 'center', 'sortable' => false, 'value' => 'mobile'],
            (object) ['text' => 'Message', 'align' => 'center', 'sortable' => false, 'value' => 'message'],
            (object) ['text' => 'Actions', 'align' => 'center', 'sortable' => false, 'value' => 'actions'],
        ];

        $response->data = $tickets->items();

        $response->pagination = new StdClass();
        $response->pagination->total = $tickets->total();
        $response->pagination->first_item = $tickets->firstItem();
        $response->pagination->last_item = $tickets->lastItem();
        $response->pagination->current_page = $tickets->currentPage();
        $response->pagination->last_page = $tickets->lastPage();

        $this->setMessage('Success Fetching Tickets');
        return $this->sendResponse($response);

    }

    public function update(Ticket $ticket, Request $request) 
    {
        $ticket->assigned_to = $request->userId;

        if ($request->has('status')) {
            $ticket->status = $request->status;
        }
        
        if ($ticket->status == Ticket::UNASSIGNED) {
            $ticket->status = Ticket::ASSIGNED;
        }

        $ticket->updated_by = $request->userId;
        $ticket->save();

        if (!$request->reply || $request->reply != "") {
            $dinstar = new StdClass();
            $configuration = Configuration::where('project_id', $request->projectId)->first();
            if ($configuration !== null) {
                $configuration->port = $ticket->port;
                $dinstar->configuration = $configuration;
                $dinstar->mobile = $ticket->mobile;
                $dinstar->message = $request->reply;
                $dinstarService = new DinstarService($dinstar);
                $response = $dinstarService->send();
    
                $conversation = new TicketConversation();
                $conversation->is_send = TicketConversation::FROM_SYSTEM;
                $conversation->ticket_id = $ticket->id;
                $conversation->user_id = $request->userId;
                $conversation->message = $request->reply;
                $conversation->save();
            }
        }

        $this->setMessage('Ticket Successfully Updated');
        return $this->sendResponse($ticket);

    }

    public function show(Ticket $ticket) 
    {
        $ticket->load(['conversation','project','assignedTo']);

        $this->setMessage('Ticket Successfully Retrieved');
        return $this->sendResponse($ticket);

    }

    public function projectsReport(Request $request) 
    {
        try {
            $ticketReport = Ticket::ticketReports($request->projectId, $request->year, $request->month);
            $response = new StdClass();

            $response->headers = [
                (object) ['text' => 'Report Year', 'align' => 'center', 'sortable' => false, 'value' => 'ReportYear'],
                (object) ['text' => 'Report Month', 'align' => 'center', 'sortable' => false, 'value' => 'ReportMonth'],
                (object) ['text' => 'Unassigned', 'align' => 'center', 'sortable' => false, 'value' => 'Unassigned'],
                (object) ['text' => 'Assigned', 'align' => 'center', 'sortable' => false, 'value' => 'Assigned'],
                (object) ['text' => 'Pending', 'align' => 'center', 'sortable' => false, 'value' => 'Pending'],
                (object) ['text' => 'Closed', 'align' => 'center', 'sortable' => false, 'value' => 'Closed'],
            ];

            foreach ($ticketReport as $key => $report) {
                $ticketReport[$key]->ReportMonth = date("F", strtotime($report->ReportYear."-" . $report->ReportMonth . "-01") );
            }
        
            $response->data =  $ticketReport;

            $reportCount = count($ticketReport);

            $response->pagination = new StdClass();
            $response->pagination->total = $reportCount;
            $response->pagination->first_item = 1;
            $response->pagination->last_item = $reportCount;
            $response->pagination->current_page = 1;
            $response->pagination->last_page = $reportCount;
            

            $response->pagination = new StdClass();
            $this->setMessage('Success Fetching Projects Report');
            return $this->sendResponse($response);
           
        } catch (Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function projectsReportYearMonth(Request $request) 
    {
        try {
            $ticketYearMonth = Ticket::ticketYearMonth();
            $ticketYears =  Ticket::ticketYears();

            $ticketYearMonth[0]->monthName = date("F", mktime(0, 0, 0, $ticketYearMonth[0]->month, 10));

            $years = [];
            foreach ($ticketYears as $yr) {
                $years[] = $yr->year;
            }
            $ticketYearMonth[0]->ticketYears = $years; //years array

            $response = new StdClass();
            $response->data = $ticketYearMonth[0];

            $this->setMessage('Success Fetching Projects Report');
            return $this->sendResponse($response);

        } catch (Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function ticketReportDownload(Request $request) 
    {

        $response = new StdClass();
        $response = $this->get($request, true);
        $response->filename = $request->filename;

        $export = new ExportExcel($response);
        $path = $export->export();

        $this->setMessage('Download Report Successful!');
        return $this->sendResponse(['url' => $path]);
    }

    protected function get(Request $request, $isExcel)
    {
        $ticket = Ticket::ticketReports($request->searchProjectId, $request->searchYear, $request->searchMonth);

        $response = new StdClass();

        if ($isExcel) {
            $response->headers = [
                'ReportYear',
                'ReportMonth',
                'Unassigned',
                'Assigned',
                'Pending',
                'Closed'
            ];
            $response->fills = [
                'ReportYear',
                'ReportMonth',
                'Unassigned',
                'Assigned',
                'Pending',
                'Closed'
            ];
        } else {
            $response->headers = [
                (object) ['text' => 'Report Year', 'align' => 'center', 'sortable' => false, 'value' => 'ReportYear'],
                (object) ['text' => 'Report Month', 'align' => 'center', 'sortable' => false, 'value' => 'ReportMonth'],
                (object) ['text' => 'Unassigned', 'align' => 'center', 'sortable' => false, 'value' => 'Unassigned'],
                (object) ['text' => 'Assigned', 'align' => 'center', 'sortable' => false, 'value' => 'Assigned'],
                (object) ['text' => 'Pending', 'align' => 'center', 'sortable' => false, 'value' => 'Pending'],
                (object) ['text' => 'Closed', 'align' => 'center', 'sortable' => false, 'value' => 'Closed'],
            ];
        }
        $response->data = $ticket;

        return $response;
    }
}