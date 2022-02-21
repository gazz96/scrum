<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\Unit;

use App\Requests\ProjectRequest;

class Projects extends MY_Controller 
{



	public function __construct() {
		parent::__construct();
	}


	private function sort_field( $id, $label, $sort = false) 
	{

		if( $sort ) {
			$order = "ASC";
			if( request('order') == "ASC") {
				$order = "DESC";
			}else {
				$order = "ASC";
			}
			return "<a href='?sort_by={$id}&sort={$order}'>{$label}</a>";
		}
		return $label;
	}

	

    public function index() 
	{
	
		$this->table->set_template([
			"table_open" => "<table class='table table-bordered' id='table'>"
		]);

		
		$this->table->set_heading([
			$this->sort_field('id', 'ID', true),
			$this->sort_field('name', 'Name', true), 
			'Unit',
			'Status', 
			'Action',
		]);

		$projects = Project::with('role');
		$projects->orderBy('id', 'DESC');
		$projects = $projects->when(request('sort'), function($query, $value){
			return $query->orderBy(request('sort_by'), $value);
		});

		$projects = $projects->when(request('keyword'), function($query, $value){
			return $query->where(request('filter_by'), 'like', '%' . $value . '%');
		});

		$projects = $projects->paginate(20);

		foreach($projects as $project) 
		{
			$this->table->add_row([
				$project->id,
				$project->name,
				$project->unit->name,
				$project->status, 
				"
				<a href='" . base_url('scrums/lists/?project_id=' . $project->id ) . "' class='btn btn-primary' title='Buat Scrum'>
					<span class='fas fa-plus'></span>
				</a>
					<a href='" . base_url('projects/edit/' . $project->id) . "' class='btn btn-warning'>
						<span class='fas fa-edit'></span>
					</a>
					<a href='" . base_url('projects/delete/' . $project->id ) . "' class='btn btn-danger'>
						<span class='fas fa-trash'></span>
					</a>
					
				"
			]);
		}

		$this->view('modules.project.lists', [
			'units' => Unit::all(),
			'table' => $this->table->generate()
		]);

    }

    public function create() 
	{
		$this->view('modules.project.create', [
			'units' 	 => Unit::all(),
			'pics' 		 => User::pic()->get(),
			'masters' 	 => User::master()->get(),
			'owners' 	 => User::owner()->get()
		]);
    }

    public function store() 
	{
		$request 	= new ProjectRequest;
		$data 		= $request->validated();	
		$user 		= Project::create( $data );
		$this->session->set_flashdata('message', 'Berhasil menyimpan');
		redirect(base_url('/projects'));
    }

    public function edit( $id ) 
	{

		$project = Project::findOrFail( $id );

		$this->view('modules.project.edit', [
			'project' 	 => $project,
			'units' 	 => Unit::all(),
			'pics' 		 => User::pic()->get(),
			'masters' 	 => User::master()->get(),
			'owners' 	 => User::owner()->get()
		]);
    }

    public function update( $id ) 
	{
		$request 	= new ProjectRequest;
		$data 		= $request->validated();	
		$project 	= Project::findOrFail( $id );
		$project->update( $data );
		
		$this->session->set_flashdata('message', 'Berhasil memperbaharui');
		redirect(base_url('/projects/edit/' . $id ));
    }

    public function delete( $id ) {
        $project = Project::findOrFail( $id );
		$project->delete();
		back();
    }

}
