<?php

/**
 * Tichet Job Controller
 * Use to test the Dinstar Service
 * Jovic
 * 2021-04-07
 */

namespace App\Http\Controllers;

use Exception;
use App\Models\Configuration;
use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Services\DinstarService;
use Illuminate\Http\Request;
use StdClass;
class TicketJobController extends Controller
{
    /**
     * Retrieve SMS from Dinstar then check for the following:
     *  - if there is open ticket for that mobile - update to response
     *  - if no open ticket, create a new one.
     * This will be trigger by the cron job
     */
    public function index(Request $request)
    {
        $dinstar = new StdClass();
        $configuration = Configuration::where('project_id', $request->project_id)->first();
        $dinstar->configuration = $configuration;
        $dinstarService = new DinstarService($dinstar);
        $response = $dinstarService->get();

        if($response->success) {
            if(!empty($response->body)) {
                foreach($response->body as $sms) {
                    $ongoingTicket = Ticket::open()->where('mobile', $sms->number)->first();
                    if(!$ongoingTicket) {
                        $ticket = new Ticket();
                        $ticket->project_id = $request->project_id;
                        $ticket->mobile = $sms->number;
                        $ticket->port = $sms->port;
                        $ticket->message = $sms->text;
                        $ticket->status = Ticket::UNASSIGNED;
                        $ticket->save();   

                        //Check if has auto-response
                        if($configuration->auto_response && $configuration->auto_response != "") {                       
                            $configuration->port = $sms->port;
                            $dinstar->configuration = $configuration;
                            $dinstar->mobile = $sms->number;
                            $dinstar->message = $configuration->auto_response;
                            $dinstarService = new DinstarService($dinstar);
                            $response = $dinstarService->send();

                            $conversation = new TicketConversation();
                            $conversation->is_send = TicketConversation::FROM_SYSTEM;
                            $conversation->ticket_id = $ticket->id;
                            $conversation->message = $configuration->auto_response;
                            $conversation->save();
                        }
                    }else {
                        $conversation = new TicketConversation();
                        $conversation->is_send = TicketConversation::FROM_MOBILE;
                        $conversation->ticket_id = $ongoingTicket->id;
                        $conversation->message = $sms->text;
                        $conversation->save();
                    }
                }
            }
            $this->setMessage('SMS Retrieving Successfully');
            return $this->sendResponse($response->body);
        } else {
            $this->setSuccess(false);
            $this->setStatus(500);
            $this->setMessage('Error on retrieving sms');
            return $this->sendResponse($response);
        }
    }
}