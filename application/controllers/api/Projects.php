<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Project;
use Illuminate\Support\Collection;
class Projects extends MY_Controller {

    public function index() {
        
        $projects = Project::query();
		$projects->orderBy('id', 'DESC');
		$projects = $projects->when(request('sort'), function($query, $value){
			return $query->orderBy(request('sort_by'), $value);
		});

		$projects = $projects->when(request('keyword'), function($query, $value){
			return $query->where(request('filter_by'), 'like', '%' . $value . '%');
		});

		$projects = $projects->paginate(20);

        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output(new Collection($projects));
        $this->output->_display();
        exit;
    }

    public function store() {
        $project 		= Project::create($this->input->post(['title', 'project_id']));
            
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($project);
        $this->output->_display();
        exit;
    }

    public function update( $id ) {
        $project = Project::findOrFail($id);
        $update = $project->update($this->input->post([
            'name',
            'description',
            'status'
        ]));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($project);
        $this->output->_display();
        exit;
    }

    public function delete( $id ) {
        $project = Project::findOrFail($id);
        $delete = $project->delete();
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($project);
        $this->output->_display();
        exit;
    }

    public function show( $id ) {
        $project = Project::findOrFail($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($project);
        $this->output->_display();
    }

}