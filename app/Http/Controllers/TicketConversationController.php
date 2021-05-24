<?php

/**
 * Ticket Statuses Controller
 * Lorenzo
 * 2021-04-27
 */

namespace App\Http\Controllers;

use Exception;
use App\Models\Configuration;
use App\Models\TicketConversation;
use Illuminate\Http\Request;
use StdClass;

class TicketConversationController extends Controller
{

    public function store(Request $request)
    {
        try {
            
            if( empty($request->reply) == false && isset($request->reply) ){
                $ticketInfo = $request->ticketInfo['ticket'];
                $message = "Hi! This is 51 Talk. \nTicket ID#: ". $ticketInfo['id']. " \nMessage: \"". $request->reply."\" \nStatus: ".$request->newStatus;

                $dinstar = new StdClass();
                $dinstar->mobile = $ticketInfo['mobile'];
                $dinstar->message = $message;
                $configuration = Configuration::where('project_id', $request->projectId)->first();
                $dinstar->configuration = $configuration;
                $dinstarService = new DinstarService($dinstar);
                $response = $dinstarService->send();
                
                //save add the reply
                $ticketConversation = new TicketConversation();
                $ticketConversation->ticket_id = $request->ticketId;
                $ticketConversation->message = $request->reply;
                $ticketConversation->created_by = $request->userId;
                $ticketConversation->save();
        
                $this->setMessage('Success Adding Reply.');
                return $this->sendResponse($ticketConversation);
            }
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function conversation(Request $request)
    {
        
        try {

            $ticketConversation = TicketConversation::with('user')->where('ticket_id', $request->ticketId)->get();


            $response = new StdClass();
            $response->data = $ticketConversation;
            $this->setMessage('Success Fetching Projects');
            return $this->sendResponse($response);
        } catch (Exception $exception) {

            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['message' => $exception->getMessage()]);
        }
        
    }
}