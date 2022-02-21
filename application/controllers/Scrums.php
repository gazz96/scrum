<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Backlog;
use App\Models\Project;
use App\Models\User;

use App\Requests\ProjectRequest;

class Scrums extends MY_Controller 
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

	

    public function lists() 
	{
	
		$this->table->set_template([
			"table_open" => "<table class='table table-bordered' id='table'>"
		]);

		
		$this->table->set_heading([
			$this->sort_field('id', 'ID', true),
			$this->sort_field('module_name', 'Module', true), 
			'Plan',
			'Rencana Tanggal Mulai',
			'Rencana Tanggal Selesai',
			'Status', 
			'Action',
		]);

		$backlogs = new Backlog();
		$backlogs->orderBy('id', 'DESC');
		$backlogs = $backlogs->when(request('sort'), function($query, $value){
			return $query->orderBy(request('sort_by'), $value);
		});

		$backlogs = $backlogs->when(request('keyword'), function($query, $value){
			return $query->where(request('filter_by'), 'like', '%' . $value . '%');
		});

		$backlogs = $backlogs->paginate(20);

		foreach($backlogs as $backlog) 
		{
			$this->table->add_row([
				$backlog->id,
				$backlog->module_name,
				$backlog->plan,
				$backlog->period_start,
				$backlog->pediod_end,
				$backlog->status, 
				"
					<a href='" . base_url('scrums/edit/' . $backlog->id) . "' class='btn btn-warning'>
						<span class='fas fa-edit'></span>
					</a>
					<a href='" . base_url('scrums/delete/' . $backlog->id . '?project_id=' . $backlog->project_id  ) . "' class='btn btn-danger'>
						<span class='fas fa-trash'></span>
					</a>
					
				"
			]);
		}

		$this->view('modules.backlog.lists', [
			'project' => Project::findOrFail( request('project_id') ),
			'table' => $this->table->generate()
		]);

    }

    public function create() 
	{
		$this->view('modules.backlog.create',[
			'developers' => User::developer()->get(),
			'project' => Project::findOrFail( request('project_id') ),
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
