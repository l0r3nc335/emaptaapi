<?php

/**
 * Declaration AgileController
 * Created by : Lorenzo Garcia
 * 2021-05-25
 */

namespace App\Http\Controllers;

use App\Models\Agile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use StdClass;




use App\Models\User;

class AgileController extends Controller
{

    public function index(Request $request)
    {
        try{
            $agile = Agile::get();

            $response = new StdClass();
            $response->headers = [
                (object) ['text' => 'Description', 'align' => 'center', 'sortable' => false, 'value' => 'description'],
                (object) ['text' => 'Type', 'align' => 'center', 'sortable' => false, 'value' => 'type'],
                (object) ['text' => 'Actions', 'align' => 'center', 'sortable' => false, 'value' => 'actions'],
            ];

            $response->data = $agile;

            $response->pagination = new StdClass();
            $response->pagination->total = count($agile);
            $response->pagination->first_item = 1;
            $response->pagination->last_item = count($agile);
            $response->pagination->current_page = 1;
            $response->pagination->last_page = 1;

            $this->setMessage('Success Fetching Agile');
            return $this->sendResponse($response);

        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $agile = new Agile();
            $agile->type = $request->type;
            $agile->description = $request->description;
            $agile->save();

            $this->setMessage('Success Adding Description.');
            return $this->sendResponse($agile);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request, Agile $agile)
    {
        try {
            $agile = Agile::where('id', 4)->first();
            $agile->delete();
            
            $this->setMessage('Description <b>' . $agile->description . '</b> deleted.');
            return $this->sendResponse($agile);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function update(Request $request, Agile $agile)
    {
        try {
            $agile->description = $request->description;
            $agile->type = $request->type;
            $agile->save();

            $this->setMessage('Success Updating Project ' . $agile->description);
            return $this->sendResponse($agile);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }
    
}
