<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\Mail\Mailer;

use App\Models\MailJob as MailJobModel;



class MailJobController extends Controller
{
    public function index()
    {
        try {
            set_time_limit(600);
            $onQueues = MailJobModel::where('status', MailJobModel::PENDING)
                ->orderBy('created_at', 'ASC')
                ->take(30)->get();

            $sending = [];
            foreach ($onQueues as $queue) {
                $sending[] = $queue->id;
            }

            MailJobModel::whereIn('id', $sending)->update(['status' => MailJobModel::SENDING]);

            $failures = [];
            foreach ($onQueues as $onQueue) {
                try {
                    $emailData = (object) [
                        'template' => $onQueue->template,
                        'subject' => $onQueue->subject,
                        'data' => json_decode($onQueue->data),
                        'logo' => env('MAIL_LOGO_PATH'),
                    ];
                    $eventMail = new Mailer($emailData);

                    if (!filter_var($onQueue->email, FILTER_VALIDATE_EMAIL)) {
                        $failures[] = $onQueue->id;
                    } else {
                        Mail::to($onQueue->email)->send($eventMail);
                    }
                } catch (\Exception $e) {
                    $failures[] = $onQueue->id;
                }
            }
            MailJobModel::whereIn('id', $sending)->whereNotIn('id', $failures)->update(['status' => MailJobModel::SENT, 'send_at' => date('Y-m-d H:i:s')]);
            MailJobModel::whereIn('id', $failures)->update(['status' => MailJobModel::FAILED]);
            $this->setMessage('Success on sending mail');

            return $this->sendResponse([]);
        } catch (\Exception $exception) {
            $this->setSuccess(false);
            $this->setStatus(500);
            $this->setMessage('Error on sending mail');
            return $this->sendResponse($exception);
        }
    }
}
