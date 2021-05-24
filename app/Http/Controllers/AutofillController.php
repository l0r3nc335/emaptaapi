<?php

/**
 * Auto Fill Controller
 * Created by : Karl Pandacan
 * 2021-01-15
 */

namespace App\Http\Controllers;

use StdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\UserAutofill;

class AutofillController extends Controller
{
    public function show(Request $request)
    {
        $autofills = UserAutofill::where('user_id', $request->userId)->first();
        if ($autofills === null) {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('No Autofill found.');
            return $this->sendResponse([]);
        }
        return $this->sendResponse($autofills);
    }

    public function update(Request $request)
    {
        $emailCount = User::where('username', $request->email)
            ->where('id', '!=', $request->userId)
            ->count();
        if ($emailCount > 0) {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('E-Mail Already Exists');
            return $this->sendResponse([]);
        } else {
            $user = User::find($request->userId);
            $user->username = $request->email;
            $user->fullname = $request->fullname;
            $user->save();
        }

        $autofills = UserAutofill::where('user_id', $request->userId)->first();
        $autofills->fullname = $request->fullname;
        $autofills->email = $request->email;
        $autofills->mobile_number = $request->mobile_number;
        $autofills->age = $request->age;
        $autofills->gender = $request->gender;
        $autofills->employee_number = $request->employee_number;
        $autofills->visitor_type = $request->visitor_type != 'Others' ? $request->visitor_type : $request->visitor_type_others;
        $autofills->nature_of_visit = $request->nature_of_visit != 'Others' ? $request->nature_of_visit : $request->nature_of_visit_others;
        $autofills->department = $request->department;
        $autofills->site = $request->site;
        $autofills->home_address = $request->home_address;
        $autofills->household_headcount = $request->household_headcount;
        $autofills->save();
    }
}
