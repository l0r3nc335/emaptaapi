<?php

/**
 * Project Controller
 * Created by : Karl Pandacan
 * 2021-04-07
 */

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ExportExcel;

use StdClass;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->search ?? '';
            $projects = Project::with('configuration')->where('code', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->paginate(Project::PER_PAGE);

            $response = new StdClass();

            $response->headers = [
                (object) ['text' => 'Code', 'align' => 'center', 'sortable' => false, 'value' => 'code'],
                (object) ['text' => 'Name', 'align' => 'center', 'sortable' => false, 'value' => 'name'],
                (object) ['text' => 'Dinstar URL', 'align' => 'center', 'sortable' => false, 'value' => 'configuration.dinstar_url'],
                (object) ['text' => 'Receive Ports', 'align' => 'center', 'sortable' => false, 'value' => 'configuration.receive_ports'],
                (object) ['text' => 'Smart Ports', 'align' => 'center', 'sortable' => false, 'value' => 'configuration.smart_ports'],
                (object) ['text' => 'Globe Ports', 'align' => 'center', 'sortable' => false, 'value' => 'configuration.globe_ports'],
                (object) ['text' => 'Actions', 'align' => 'center', 'sortable' => false, 'value' => 'actions'],
            ];

            $response->data = $projects->items();

            $response->pagination = new StdClass();
            $response->pagination->total = $projects->total();
            $response->pagination->first_item = $projects->firstItem();
            $response->pagination->last_item = $projects->lastItem();
            $response->pagination->current_page = $projects->currentPage();
            $response->pagination->last_page = $projects->lastPage();

            $this->setMessage('Success Fetching Projects');
            return $this->sendResponse($response);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function show(Project $project)
    {
        $project->load('configuration');
        $this->setMessage('Success Fetching Project.');
        return $this->sendResponse($project);
    }

    public function store(Request $request)
    {
        try {
            $project = new Project();
            $project->code = $request->code;
            $project->name = $request->name;
            $project->save();

            $configuration = new Configuration();
            $configuration->project_id = $project->id;
            $configuration->dinstar_url = $request->configuration['dinstar_url'];
            $configuration->receive_ports = $request->configuration['receive_ports'];
            $configuration->smart_ports = $request->configuration['smart_ports'];
            $configuration->globe_ports = $request->configuration['globe_ports'];
            $configuration->token = $request->configuration['token'];
            $configuration->save();

            $this->setMessage('Success Adding Project.');
            return $this->sendResponse($project);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function update(Request $request, Project $project)
    {
        try {
            $project->code = $request->code;
            $project->name = $request->name;
            $project->save();
            $configuration = Configuration::where('project_id', $project->id)->first();
            $configuration->dinstar_url = $request->configuration['dinstar_url'];
            $configuration->receive_ports = $request->configuration['receive_ports'];
            $configuration->smart_ports = $request->configuration['smart_ports'];
            $configuration->globe_ports = $request->configuration['globe_ports'];
            $configuration->token = $request->configuration['token'];
            $configuration->auto_response = $request->configuration['auto_response'];
            $configuration->save();

            $this->setMessage('Success Updating Project ' . $project->name);
            return $this->sendResponse($project);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request, Project $project)
    {
        try {
            $project->updated_by = $request->userId;
            $project->delete();
            
            $configuration = Configuration::where('project_id', $project->id);
            $configuration->updated_by = $request->userId;
            $configuration->delete();

            $this->setMessage('Project <b>' . $project->name . '</b> deleted.');
            return $this->sendResponse($project);
        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }
    public function activeProjects(Request $request)
    {
        try {
            
            $projects = Project::select('id','code', 'name')->where('active', '1')->get();
            return $this->sendResponse($projects);

        } catch (\Exception $exception) {
            $this->setStatus(500);
            $this->setSuccess(false);
            $this->setMessage('Something went wrong! Please contact the Administrator.');
            return $this->sendResponse(['request' => $request->all(), 'message' => $exception->getMessage()]);
        }
    }
}
