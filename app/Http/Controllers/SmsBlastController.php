<?php

/**
 * SMS Blast Controller
 * Created by : Karl Pandacan
 * 2021-04-19
 */

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

use StdClass;
use App\Models\SmsBlast;
use App\Models\SmsBlastNumber;
use App\Services\DinstarService;

class SmsBlastController extends Controller
{
    public function index(Request $request)
    {
        try {
            $isExcel = ($request->has('isexcel') && $request->isexcel == 1);
            $search = $request->search ?? '';
            $smsBlasts = SmsBlast::where('message', 'LIKE', '%' . $search . '%')->paginate(SmsBlast::PER_PAGE);

            $response = new StdClass();

            if (!$isExcel) {
                $response->headers = [
                    (object) ['text' => 'Message', 'align' => 'center', 'sortable' => false, 'value' => 'message'],
                    (object) ['text' => 'Errors', 'align' => 'center', 'sortable' => false, 'value' => 'error_count'],
                    (object) ['text' => 'Sent', 'align' => 'center', 'sortable' => false, 'value' => 'success_count'],
                    (object) ['text' => 'Status', 'align' => 'center', 'sortable' => false, 'value' => 'status'],
                ];
            }

            if ($isExcel) {
                $response->data = [];
                $blasts = $smsBlasts->items();
                foreach ($blasts as $blast) {
                    $response->data[] = (object)[
                        'Message' => $blast->message,
                        'Errors Count' => $blast->error_count,
                        'Sent Count' => $blast->success_count,
                        'Status' => $blast->status
                    ];
                }
            } else {
                $response->data = $smsBlasts->items();
            }

            if (!$isExcel) {
                $response->pagination = new StdClass();
                $response->pagination->total = $smsBlasts->total();
                $response->pagination->first_item = $smsBlasts->firstItem();
                $response->pagination->last_item = $smsBlasts->lastItem();
                $response->pagination->current_page = $smsBlasts->currentPage();
                $response->pagination->last_page = $smsBlasts->lastPage();
            }

            $this->setMessage('Success Fetching SMS Blasts');
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
        $response = new StdClass();
        if (!$request->has('message') || $request->message == '') {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('Message is required');
        }
        if (!$request->hasFile('file') || $request->file == '') {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('CSV File is Required');
            return $this->sendResponse($response);
        } else {
            if (strtolower($request->file->getClientOriginalExtension()) == '.csv') {
                $this->setStatus(400);
                $this->setSuccess(false);
                $this->setMessage('File is not CSV');
                return $this->sendResponse($response);
            }
        }
        try {
            $smsBlast = new SmsBlast();
            $smsBlast->message = $request->message;
            $smsBlast->status = SmsBlast::STATUS_PENDING;
            $smsBlast->success_count = 0;
            $smsBlast->error_count = 0;
            $smsBlast->created_by = $request->userId ?? 0;
            $smsBlast->updated_by = $request->userId ?? 0;
            $smsBlast->save();

            $configuration = Configuration::where('project_id', $request->projectId)->first();
            /** Reading CSV File */
            $file = fopen($request->file, "r");
            $itemCount = 2;
            $successCount = 0;
            $errorCount = 0;
            $firstLine = true;
            $timeout = 30;
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
                ini_set('max_execution_time', $timeout);
                if ($firstLine) {
                    $firstLine = false;
                    continue;
                }

                $mobileNumber = (string)trim($getData[0]);
                if (substr($mobileNumber, 0, 2) == '09') {
                    if (strlen($mobileNumber) != 11) {
                        $errorCount++;
                        $itemCount++;
                        continue;
                    }
                    $mobileNumber = '639' . substr($mobileNumber, 2);
                } else if (substr($mobileNumber, 0, 3) == '639') {
                    if (strlen($mobileNumber) != 12) {
                        $errorCount++;
                        $itemCount++;
                        continue;
                    }
                    $mobileNumber = '639' . substr($mobileNumber, 3);
                } else if (substr($mobileNumber, 0, 4) == '+639') {
                    if (strlen($mobileNumber) != 13) {
                        $errorCount++;
                        $itemCount++;
                        continue;
                    }
                    $mobileNumber = '639' . substr($mobileNumber, 4);
                } else {
                    $errorCount++;
                    $itemCount++;
                    continue;
                }

                $dinstar = new StdClass();
                $dinstar->mobile = $mobileNumber;
                $dinstar->message = $request->message;
                $dinstar->configuration = $configuration;
                $dinstarService = new DinstarService($dinstar);
                $response = $dinstarService->send();

                if ($response->success) {
                    $status = SmsBlastNumber::STATUS_SENT;
                    $errorCount++;
                } else {
                    $status = SmsBlastNumber::STATUS_FAILED;
                    $successCount++;
                }

                $smsBlastNumber = new SmsBlastNumber();
                $smsBlastNumber->sms_blast_id = $smsBlast->id;
                $smsBlastNumber->mobile_number = $mobileNumber;
                $smsBlastNumber->status = $status;
                $smsBlastNumber->created_by = $request->userId ?? 0;
                $smsBlastNumber->updated_by = $request->userId ?? 0;
                $smsBlastNumber->save();
                $itemCount++;
            }

            $smsBlast->success_count = $successCount;
            $smsBlast->error_count = $errorCount;
            $smsBlast->status = SmsBlast::STATUS_SENT;
            $smsBlast->save();

            if ($errorCount > 0 && $successCount > 0) {
                $message = 'SMS Blast Successfully send with ' . $errorCount . ' failed';
                $alertType = 'warning';
            } else if ($errorCount > 0 && $successCount == 0) {
                $message = 'SMS Blast created but there is no valid numbers';
                $alertType = 'error';
            } else {
                $message = 'SMS Blast Successfully Created';
                $alertType = 'success';
            }

            $this->setStatus(200);
            $this->setSuccess(true);
            $this->setMessage($message);
            return $this->sendResponse((object)['alert_type' => $alertType]);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }
}
