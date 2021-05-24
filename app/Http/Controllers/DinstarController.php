<?php

/**
 * Dinstar Controller
 * Use to test the Dinstar Service
 * Jovic
 * 2021-04-07
 */

namespace App\Http\Controllers;

use Exception;
use App\Models\Configuration;
use App\Models\Project;
use App\Services\DinstarService;
use Illuminate\Http\Request;
use StdClass;
class DinstarController extends Controller
{

    public function sendSMS(Request $request)
    {

        $dinstar = new StdClass();
        $dinstar->mobile = $request->mobile;
        $dinstar->message = $request->message;
        $configuration = Configuration::where('project_id', $request->projectId)->first();
 
        if(!($configuration === null)) {
            $dinstar->configuration = $configuration;
            $dinstarService = new DinstarService($dinstar);
            $response = $dinstarService->send();
        }

        if($response->success) {
            $this->setMessage('SMS Sending Successfully');
            return $this->sendResponse($response);
        } else {
            $this->setSuccess(false);
            $this->setStatus(500);
            $this->setMessage('Error on sending sms');
            return $this->sendResponse($response);
        }
    }


    public function getSMS(Request $request)
    {
        $dinstar = new StdClass();
        $configuration = new StdClass();
        $configuration = Configuration::where('project_id', $request->project_id)->first();

        if(!($configuration === null)) {
            $dinstar->configuration = $configuration;
            $dinstarService = new DinstarService($dinstar);
            $response = $dinstarService->get();
        }

        if($response->success) {
            $this->setMessage('SMS Retrieving Successfully');
            return $this->sendResponse($response);
        } else {
            $this->setSuccess(false);
            $this->setStatus(500);
            $this->setMessage('Error on sending sms');
            return $this->sendResponse($response);
        }
    }
}