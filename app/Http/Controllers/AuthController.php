<?php

namespace App\Http\Controllers;

use stdClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\Mailer;

use App\Models\User;
use App\Models\UserType;
use App\Models\UserAutofill;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $requiredFields = ['username', 'password'];
        if (
            !$request->has($requiredFields) ||
            $request->username == '' ||
            $request->password == ''
        ) {
            $this->setMessage('Username and Password is required.');
            return $this->sendResponse(['required-fileds' => $requiredFields], false, 404);
        }

        $username = $request->input('username');
        $password = $request->input('password');
        // $user = User::with('type')->login($username, $password)->first();
        $user = User::login($username, $password)->first();
        if (!$user) {
            $this->setMessage('Invalid username or password');
            return $this->sendResponse(['required-fileds' => $requiredFields], false, 404);
        }
        $hash = md5($username . time()) . md5($user->id . time());
        $user->token = $hash;
        $user->token_expired_at = Carbon::now()->addHours(3);

        $user->save();
        // $user->usertype = $user->type->code;
        $this->setMessage('Login successful.');
        return $this->sendResponse($user);
    }

    public function logout(Request $request)
    {
        $requestToken = $request->header('x-51talk-session-id');
        $user = User::where('token', $requestToken)->first();
        $user->token = '';
        $user->token_expiry_at = date('Y-m-d 00:00:00', strtotime('-1 day', date('Y-m-d')));
        $user->save();
    }

    public function tokenCheck(Request $request)
    {
        $requestToken = $request->header('x-51talk-session-id');
        if ($requestToken === null) {
            return $this->sendResponse([], false, 401, 'You are not Authorized to make this request.');
        }

        $activeToken = User::where('token', $requestToken)
            ->where('token_expired_at', '>=', Carbon::now())->first();
        if (!$activeToken) {
            return $this->sendResponse([], false, 401, 'Session Expired or Invalid.');
        }
        $this->setMessage('Token Still Active');
        return $this->sendResponse([]);
    }

    public function changePassword(Request $request)
    {
        $user = User::find($request->userId);
        $dbPassword = $user->password;
        $currentPassword = md5($request->current_password);
        $newPassword = md5($request->new_password);
        if ($dbPassword != $currentPassword) {
            return $this->sendResponse([], false, 401, 'Current password is incorrect.');
        } else {
            $user->password = $newPassword;
        }
        $user->save();
        $this->setMessage('Change password successful.');
        return $this->sendResponse([]);
    }

    public function register(Request $request)
    {
        $count = User::where('username', $request->email)->count();
        if ($count > 0) {
            return $this->sendResponse([], false, 401, 'E-Mail already exists.');
        } else {
            $user = new User();
            $user->user_type_id = UserType::where('code', 'registrant')->first()->id ?? 0;
            $user->fullname = $request->fullname;
            $user->username = $request->email;
            $user->password = md5($request->password);
            $hash = md5($request->email . time()) . md5($user->fullname . time());
            $user->token = $hash;
            $user->token_expired_at = Carbon::now()->addHours(3);
            $user->save();
        }

        $userAutoFills = new UserAutofill();
        $userAutoFills->user_id = $user->id;
        $userAutoFills->fullname = $request->fullname;
        $userAutoFills->email = $request->email;
        $userAutoFills->mobile_number = $request->mobile_number;
        $userAutoFills->age = $request->age;
        $userAutoFills->gender = $request->gender;
        $userAutoFills->employee_number = $request->employee_number;
        $userAutoFills->visitor_type = $request->visitor_type != 'Others' ? $request->visitor_type : $request->visitor_type_others;
        $userAutoFills->nature_of_visit = $request->nature_of_visit != 'Others' ? $request->nature_of_visit : $request->nature_of_visit_others;
        $userAutoFills->department = $request->department;
        $userAutoFills->site = $request->site;
        $userAutoFills->home_address = $request->home_address;
        $userAutoFills->household_headcount = $request->household_headcount;
        $userAutoFills->save();

        $this->setMessage('Registration successful you can now login.');
        return $this->sendResponse([]);
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('username', $request->email)->first();
        if ($user === null) {

            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('We cannot found your account.');
            return $this->sendResponse([]);
        }
        $hash = md5($user->username . time()) . md5($user->id . time());
        $user->token = $hash;
        $user->token_expired_at = Carbon::now()->addHours(24);
        $user->save();

        $appData = (object) [
            'resetUrl' => env('PASSWORD_RESET_URL') . '/reset-password/' . $user->token,
            'logo' => env('PASSWORD_RESET_IMAGE_URL'),
            'name' => 'Reset Your Password',
        ];

        $data = new stdClass();
        $data->template = 'reset-password';
        $data->subject = 'Reset Password Request';
        $data->user = $user;
        $data->app = $appData;
        Mail::to($user->username)->send(new Mailer($data));

        $this->setMessage('Instruction to Reset your password has been sent to your email');
        return $this->sendResponse([]);
    }


    public function reset(Request $request)
    {
        $user = User::where('token', $request->token)
            ->where('token_expired_at', '>=', Carbon::now())->first();

        if ($user === null) {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('Please reset password again.');
            return $this->sendResponse(['invalid-token']);
        }
        if (
            !$request->has('new_password') ||
            $request->new_password == '' ||
            !$request->has('confirm_password') ||
            $request->confirm_password == ''
        ) {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('Missing Password or Confirm Password');
            return $this->sendResponse(['new_password']);
        }
        if ($request->has(['new_password', 'confirm_password']) && $request->new_password !== $request->confirm_password) {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('Password does not matched.');
            return $this->sendResponse(['fields' => ['new_password', 'confirm_password']]);
        }

        $user->password = md5($request->new_password);
        $user->token = '';
        $user->token_expired_at = Carbon::now();

        $user->save();

        $this->setMessage('Password successfully updated you can now login using your new password.');
        return $this->sendResponse($user);
    }

    public function check($token)
    {
        $user = User::where('token', $token)
            ->where('token_expired_at', '>=', Carbon::now())->first();

        if ($user === null) {
            $this->setStatus(400);
            $this->setSuccess(false);
            $this->setMessage('Invalid Token');
            return $this->sendResponse(['invalid-token']);
        }

        $this->setMessage('Token is valid.');
        return $this->sendResponse(['token-valid']);
    }
}
