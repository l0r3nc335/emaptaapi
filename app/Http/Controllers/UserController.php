<?php

/**
 * Created By Lorenzo Garcia
 * 2021-04-16
 */

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Configuration;
use StdClass;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->search ?? '';
            $users = User::where('name', 'LIKE', '%' . $search . '%') ->orWhere('email', 'LIKE', '%' . $search . '%')->orderBy('id', 'asc')->paginate(User::PER_PAGE);

            $response = new StdClass();

            $response->headers = [
                (object) ['text' => '#', 'align' => 'center', 'sortable' => false, 'value' => 'id'],
                (object) ['text' => 'Project Code', 'align' => 'center', 'sortable' => false, 'value' => 'project.code'],
                (object) ['text' => 'Project Name', 'align' => 'center', 'sortable' => false, 'value' => 'project.name'],
                (object) ['text' => 'Name', 'align' => 'center', 'sortable' => false, 'value' => 'name'],
                (object) ['text' => 'Username', 'align' => 'center', 'sortable' => false, 'value' => 'username'],
                (object) ['text' => 'Email', 'align' => 'center', 'sortable' => false, 'value' => 'email'],
                (object) ['text' => 'Actions', 'align' => 'center', 'sortable' => false, 'value' => 'actions'],
            ];

            $response->data = $users->items();

            $response->pagination = new StdClass();
            $response->pagination->total = $users->total();
            $response->pagination->first_item = $users->firstItem();
            $response->pagination->last_item = $users->lastItem();
            $response->pagination->current_page = $users->currentPage();
            $response->pagination->last_page = $users->lastPage();

            $this->setMessage('Success Fetching Users');
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
            $user = new User();
            if($request->project != "" ||  empty($request->project) == false ){
                $user->project_id = $request->project;
            }
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = md5($request->password);
            $user->save();

            $this->setMessage('Success Adding User.');
            return $this->sendResponse($user);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function update(Request $request, User $user)
    {   
        try {
            if($request->project > 0 && $request->project != $request->currentProjectId && is_array($request->project) == false){
                if($request->currentProjectId != $request->project){
                    $user->token = "";
                }
                $user->project_id = $request->project;
            }
            if($request->password != "" || $request->password != null){
                $user->password = md5($request->password);
            }
            $user->name = $request->name;
            $user->email = $request->email;


            $user->save();
            $this->setMessage('Success Updating User ' );
            
            return $this->sendResponse($request);
            
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request, User $user)
    {
        try {
            $user->delete();
            $this->setMessage('User <b>' . $user->name . '</b> deleted.');
            return $this->sendResponse($user);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }
}
