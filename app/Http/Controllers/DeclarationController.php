<?php

/**
 * Declaration Controller
 * Created by : Karl Pandacan
 * 2020-07-26
 */

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Site;
use App\Models\MailJob;
use App\Mail\Mailer;
use App\Models\Declaration;
use App\Services\SMSSending;
use App\Services\ExportExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use StdClass;

class DeclarationController extends Controller
{

    protected function get(Request $request, $isExcel)
    {
        $declarations = Declaration::where('fullname', 'LIKE', '%' . $request->fullname . '%')
            ->whereBetween('date', [$request->date_from, $request->date_to]);
        if ($request->condition !== 'All') {
            $declarations = $declarations->where('passed', $request->condition == 'Passed');
        }
        if ($request->site !== 'All') {
            $declarations = $declarations->where('site', $request->site);
        }
        if ($isExcel) {
            $declarations = $declarations->get();
        } else {
            $declarations = $declarations->paginate(Declaration::PER_PAGE);
        }
        $response = new StdClass();


        if ($isExcel) {
            $response->headers = [
                'Status',
                'Date',
                'Full Name',
                'Mobile Number',
                'E-Mail',
                'Age',
                'Gender',
                'Visitor Type',
                'Nature of Visit',
                'Department',
                'Site',
                'Employee Number',
                'Temperature',
                'Home Address',
                '1. Are you experiencing any of the following? Please check.',
                '2. Have you been in contact or stayed in a closed environment with a person potentially exposed to COVID-19 and/or confirmed COVID-19 person, or anyone related or had contact with a confirmed COVID-19 patient? (Friend, Relative, Neighbor, Colleague)',
                '3. Did you have any contact with someone with fever, cough, colds, sore throat in the past 3 weeks?',
                '4. Have you travelled outside the Philippines in the past 14 days?',
                '5. Have you ever travelled to any area in your Region aside from your home in the last 14 days?',
                '6. List the places you\'ve been to yesterday (For Contract Tracing)',
                '1. How many are you in the house?',
                '2. Is there anyone currently ill in the household?',
                'If yes, what are the symptoms',
                '3. How long has the symptoms existed',
                '4. Has a medical Worker/Doctor examined the patient?',
                '5. Can you give an overview of the examination result?',
                '6. Do you manifest any of the following symptoms? Please check.',
                '6a. Do you have any pre existing health conditions that may put you at high risk of COVID-19?',
                'If yes, where and when?',
                '7. Have you attended a mass gathering/meeting in the last 14 days?',
                'If yes, where and when?',
                '8. Did anyone from your household attended a mass gathering/meeting in the last 14 days?',
                'If yes, where and when?',
            ];
            $response->fills = [
                'passed',
                'date',
                'fullname',
                'mobile_number',
                'email',
                'age',
                'gender',
                'visitor_type',
                'nature_of_visit',
                'department',
                'site',
                'employee_number',
                'temperature',
                'home_address',
                'health_check',
                'contact_covid',
                'contact_flu',
                'travelled_outside_ph',
                'travelled_ncr',
                'places_yesterday',
                'household_headcount',
                'ill_in_household',
                'ill_in_household_symptoms',
                'ill_in_household_how_long',
                'ill_in_household_is_examined',
                'ill_in_household_exam_result',
                'symptoms_check',
                'pre_existing_conditions',
                'pre_existing_conditions_yes',
                'mass_gathering',
                'mass_gathering_yes',
                'household_mass_gathering',
                'household_mass_gathering_yes',
            ];
        } else {
            $response->headers = [
                (object) ['text' => 'Date', 'align' => 'center', 'sortable' => false, 'value' => 'date'],
                (object) ['text' => 'Full Name', 'sortable' => false, 'value' => 'fullname'],
                (object) ['text' => 'Employee Number', 'sortable' => false, 'value' => 'employee_number'],
                (object) ['text' => 'Email', 'align' => 'center', 'sortable' => false, 'value' => 'email'],
                (object) ['text' => 'Mobile Number', 'align' => 'center', 'sortable' => false, 'value' => 'mobile_number'],
                (object) ['text' => 'Status', 'align' => 'center', 'sortable' => false, 'value' => 'passed'],
                (object) ['text' => 'Actions', 'align' => 'center', 'sortable' => false, 'value' => 'actions'],
            ];
        }
        $response->data = [];
        foreach ($declarations as $key => $declaration) {
            $response->data[$key] = new StdClass();
            $response->data[$key]->id = $declaration->id;
            $response->data[$key]->date = $declaration->date->format('Y-m-d');
            $response->data[$key]->fullname = $declaration->fullname;
            $response->data[$key]->employee_number = $declaration->employee_number;
            $response->data[$key]->email = $declaration->email;
            $response->data[$key]->mobile_number = $declaration->mobile_number;
            $response->data[$key]->passed = $declaration->passed ? 'Passed' : 'Failed';
            $response->data[$key]->age = $declaration->age;
            $response->data[$key]->gender = $declaration->gender;
            $response->data[$key]->visitor_type = $declaration->visitor_type;
            $response->data[$key]->nature_of_visit = $declaration->nature_of_visit;
            $response->data[$key]->department = $declaration->department;
            $response->data[$key]->site = $declaration->site;
            $response->data[$key]->temperature = $declaration->temperature;
            $response->data[$key]->home_address = $declaration->home_address;

            $response->data[$key]->places_yesterday = $declaration->places_yesterday;
            $response->data[$key]->household_headcount = $declaration->household_headcount;
            $response->data[$key]->ill_in_household_symptoms = $declaration->ill_in_household_symptoms;
            $response->data[$key]->ill_in_household_how_long = $declaration->ill_in_household_how_long;
            $response->data[$key]->ill_in_household_exam_result = $declaration->ill_in_household_exam_result;
            $response->data[$key]->pre_existing_conditions_yes = $declaration->pre_existing_conditions_yes;
            $response->data[$key]->mass_gathering_yes = $declaration->mass_gathering_yes;
            $response->data[$key]->household_mass_gathering_yes = $declaration->household_mass_gathering_yes;
            if ($isExcel) {
                $response->data[$key]->health_check = str_replace(["[", "\"", "]"], "", $declaration->health_check);
                $response->data[$key]->contact_covid = $declaration->contact_covid ? 'Yes' : 'No';
                $response->data[$key]->contact_flu = $declaration->contact_flu ? 'Yes' : 'No';
                $response->data[$key]->travelled_outside_ph = $declaration->travelled_outside_ph ? 'Yes' : 'No';
                $response->data[$key]->travelled_ncr = $declaration->travelled_ncr ? 'Yes' : 'No';
                $response->data[$key]->symptoms_check = str_replace(["[", "\"", "]"], "", $declaration->symptoms_check);
                $response->data[$key]->ill_in_household = $declaration->ill_in_household ? 'Yes' : 'No';
                $response->data[$key]->ill_in_household_is_examined = $declaration->ill_in_household_is_examined ? 'Yes' : 'No';
                $response->data[$key]->pre_existing_conditions = $declaration->pre_existing_conditions ? 'Yes' : 'No';
                $response->data[$key]->mass_gathering = $declaration->mass_gathering ? 'Yes' : 'No';
                $response->data[$key]->household_mass_gathering = $declaration->household_mass_gathering ? 'Yes' : 'No';
            } else {
                $response->data[$key]->health_check = json_decode($declaration->health_check);
                $response->data[$key]->contact_covid = $declaration->contact_covid == 1;
                $response->data[$key]->contact_flu = $declaration->contact_flu == 1;
                $response->data[$key]->travelled_outside_ph = $declaration->travelled_outside_ph == 1;
                $response->data[$key]->travelled_ncr = $declaration->travelled_ncr == 1;
                $response->data[$key]->symptoms_check = json_decode($declaration->symptoms_check);
                $response->data[$key]->ill_in_household = $declaration->ill_in_household == 1;
                $response->data[$key]->ill_in_household_is_examined = $declaration->ill_in_household_is_examined == 1;
                $response->data[$key]->pre_existing_conditions = $declaration->pre_existing_conditions == 1;
                $response->data[$key]->mass_gathering = $declaration->mass_gathering == 1;
                $response->data[$key]->household_mass_gathering = $declaration->household_mass_gathering == 1;
            }
        }

        if (!$isExcel) {
            $response->pagination = new StdClass();
            $response->pagination->total = $declarations->total();
            $response->pagination->first_item = $declarations->firstItem();
            $response->pagination->last_item = $declarations->lastItem();
            $response->pagination->current_page = $declarations->currentPage();
            $response->pagination->last_page = $declarations->lastPage();
        }

        return $response;
    }

    public function index(Request $request)
    {
        $response = new StdClass();
        $response = $this->get($request, false);
        $this->setMessage('Fetch Declarations Successful!');
        return $this->sendResponse($response);
    }

    public function downloadExcel(Request $request)
    {
        $response = new StdClass();
        $response = $this->get($request, true);
        $response->filename = $request->filename;

        $export = new ExportExcel($response);
        $path = $export->export();

        $this->setMessage('Download Declarations Successful!');
        return $this->sendResponse(['url' => $path]);
    }
    /**
     * Insert to DB 
     */
    public function store(Request $request)
    {
        set_time_limit(120);
        $declaration = new Declaration();
        $declaration->date = $request->date;
        $declaration->fullname = $request->fullname;
        $declaration->email = $request->email;
        $declaration->mobile_number = $request->mobile_number;
        $declaration->age = $request->age;
        $declaration->gender = $request->gender;
        $declaration->employee_number = $request->employee_number;
        $declaration->visitor_type = $request->visitor_type != 'Others' ? $request->visitor_type : $request->visitor_type_others;
        $declaration->nature_of_visit = $request->nature_of_visit != 'Others' ? $request->nature_of_visit : $request->nature_of_visit_others;
        $declaration->temperature = $request->temperature;
        $declaration->department = $request->department;
        $declaration->site = $request->site;
        $declaration->home_address = $request->home_address;
        $declaration->health_check = json_encode($request->health_check);
        $declaration->contact_covid = $request->contact_covid ? 1 : 0;
        $declaration->contact_flu = $request->contact_flu  ? 1 : 0;
        $declaration->travelled_outside_ph = $request->travelled_outside_ph  ? 1 : 0;
        $declaration->travelled_ncr = $request->travelled_ncr ? 1 : 0;
        $declaration->pre_existing_conditions = $request->pre_existing_conditions ? 1 : 0;
        $declaration->pre_existing_conditions_yes = $request->pre_existing_conditions_yes;
        $declaration->places_yesterday = $request->places_yesterday;
        $declaration->household_headcount = $request->household_headcount;
        $declaration->ill_in_household = $request->ill_in_household;
        $declaration->ill_in_household_symptoms = $request->ill_in_household_symptoms;
        $declaration->ill_in_household_how_long = $request->ill_in_household_how_long;
        $declaration->ill_in_household_is_examined = $request->ill_in_household_is_examined;
        $declaration->ill_in_household_exam_result = $request->ill_in_household_exam_result;
        $declaration->symptoms_check = json_encode($request->symptoms_check);
        $declaration->mass_gathering = $request->mass_gathering ? 1 : 0;
        $declaration->mass_gathering_yes = $request->mass_gathering_yes ?? '';
        $declaration->household_mass_gathering = $request->household_mass_gathering ? 1 : 0;
        $declaration->household_mass_gathering_yes = $request->household_mass_gathering_yes ?? '';

        $isPassed = true;
        $failedHealthChecks = [
            'Sore Throat',
            'Fever for the past few days',
        ];
        $failedSymptoms = [
            "Fever",
            "Dry Cough",
            "Sore throat",
            "Loss of taste or smell",
            "Chills",
            "Nausea, Diarrhea, Vomiting",
            "Difficulty breathing or shortness of breath"
        ];
        if (
            $request->contact_covid ||
            $request->contact_flu ||
            $request->travelled_outside_ph ||
            $request->ill_in_household ||
            $request->pre_existing_conditions ||
            ((float)$request->temperature > 37.40)
        ) {
            $isPassed = false;
        }
        foreach ($failedHealthChecks as $failedHealthCheck) {
            if (in_array($failedHealthCheck, $request->health_check)) {
                $isPassed = false;
            }
        }
        foreach ($failedSymptoms as $failedSymptom) {
            if (in_array($failedSymptom, $request->symptoms_check)) {
                $isPassed = false;
            }
        }
        $declaration->passed = $isPassed ? 1 : 0;
        $declaration->passedText = $isPassed ? 'passed' : 'failed';

        /** Sending SMS to Visitor */
        $smsDetails = new \StdClass();
        $smsDetails->mobile = substr_replace($request->mobile_number, "639", 0, 2);
        if ($isPassed) {
            $smsDetails->text = 'Thank you for answering the 51Talk Health Declaration Form ' . $request->fullname . '. You may proceed to office on ' . date('Y-m-d', strtotime($request->date)) . '. This is an auto generated SMS, please do not reply.';
            $webText = 'Thank you for answering the 51Talk Health Declaration Form ' . $request->fullname . '. You may proceed to office on ' . date('Y-m-d', strtotime($request->date)) . '.';
        } else {
            $smsDetails->text = 'Thank you for answering the 51Talk Health Declaration Form ' . $request->fullname . '. Our HR team will reach out to you for further verification. This is an auto generated SMS, please do not reply.';
            $webText = 'Thank you for answering the 51Talk Health Declaration Form ' . $request->fullname . '. Our HR team will reach out to you for further verification.';
        }
        if (env('NOTIFICATION_SMS', true)) {
            $sms = new SMSSending($smsDetails);
            $result = $sms->send();
            if (!$result->success) {
                $this->setStatus(500);
                $this->setSuccess(false);
                $this->setMessage($result->message);
                return $this->sendResponse(['E-Mail' => $declaration->mobile_number, 'Stack Trace' => $result->body]);
            }
        }
        if (env('NOTIFICATION_EMAIL', true)) {
            /** Sending Email to HR */
            $mailJob = new MailJob();
            $mailJob->subject =
                strtoupper($declaration->passedText) . "_" .
                $request->site . "_" .
                $request->fullname  . "_" .
                $request->department  . "_" .
                $request->employee_number . "_HDF";
            $mailJob->template = 'hdf-to-hr';
            $mailJob->email = env('MAIL_HR_EMAIL');
            $mailJob->data = json_encode($declaration);
            $mailJob->status = MailJob::PENDING;
            $mailJob->created_at = date('Y-m-d H:i:s');
            $mailJob->save();

            /** Sending Email to Visitor */
            unset($declaration->emailSubject);
            $mailJob = new MailJob();
            $mailJob->subject = '51Talk Health Declaration Result';
            $mailJob->template = 'hdf-to-visitor';
            $mailJob->email = $request->email;
            $mailJob->data = json_encode($declaration);
            $mailJob->status = MailJob::PENDING;
            $mailJob->created_at = date('Y-m-d H:i:s');
            $mailJob->save();
        }
        unset($declaration->template);
        unset($declaration->passedText);

        $declaration->save();

        $this->setMessage('Submit Health Declaration Form Success!');
        return $this->sendResponse(
            (object)[
                'isPassed' => $isPassed ? 'passed' : 'failed',
                'message' => $webText
            ]
        );
    }

    public function dropdowns()
    {
        try {
            $response = new StdClass();
            $sites = Site::all();
            $departments = Department::all();
            $response->sites = [];
            foreach ($sites as $site) {
                $response->sites[] = $site->name;
            }
            $response->departments = [];
            foreach ($departments as $department) {
                $response->departments[] = $department->name;
            }
            $this->setMEssage('Success Fetching Drop Downs.');
            return $this->sendResponse($response);
        } catch (\Exception $e) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong.');
            return $this->sendResponse($e);
        }
    }
}
