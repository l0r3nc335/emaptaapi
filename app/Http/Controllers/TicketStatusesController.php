<?php

/**
 * Ticket Statuses Controller
 * Lorenzo
 * 2021-04-27
 */

namespace App\Http\Controllers;

use Exception;
use App\Models\Configuration;
use App\Models\TicketStatuses;
use Illuminate\Http\Request;
use StdClass;

class TicketStatusesController extends Controller
{

    public function index(Request $request)
    {

        $tickets = TicketStatuses::all();
        return $this->sendResponse($tickets);
    }
}