<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Project;
use Illuminate\Support\Collection;
use App\Models\CardItem;
use App\Models\Card;
class Projects extends MY_Controller {

    public function index() {
        
        $projects = Project::with('customer');
        $columns = $this->input->get('columns');

		$projects = $projects->when( $this->input->get('order'), function($query, $value) use( $columns ){
			return $query->orderBy($columns[$value[0]['column']]['name'], $value[0]['dir']);
		}, function( $query ){
            return $query->orderBy('id', 'DESC');
        });

		$projects = $projects->when($this->input->get('search')['value'] ?? '', function($query, $search){
			return $query->where(function($query) use ($search){
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas ('customer', function($query) use($search){
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
		});

        $projects = $projects->when($this->input->get('status'), function($query, $status){
            return $query->where('status', $status);
        });

		$projects = $projects->paginate($this->input->get('length', 20), ['*'], 'page', $this->input->get('page'));
        $projectsCollections = new Collection($projects);
        $projectsCollections->draw = $this->input->get('draw');

        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($projectsCollections);
        $this->output->_display();
        exit;
    }

    public function store() {
        $project 		= Project::create($this->input->post([
            'code',
            'name', 
            'customer_id',
            'start_date',
            'end_date',
            'status'
        ]));
            
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
            'customer_id',
            'start_date',
            'end_date',
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
        exit;
    }

    public function edit( $id ) {
        $project = Project::with('customer')->findOrFail($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($project);
        $this->output->_display();
        exit;
    }

    public function total_tasks($project_id) {

        $project = new Collection(Card::where('project_id', $project_id)->get());
        $card_ids = $project->pluck('id');

        $total_task      = CardItem::whereIn('card_id', $card_ids)->count('id');
        $completed_task  = CardItem::whereIn('card_id', $card_ids)->where('status', 'Completed')->count('id');
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output(json_encode([
            'total' => $total_task,
            'completed' => $completed_task,
        ]));
        $this->output->_display();
        exit;
    }

}