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




	

    public function index() 
	{

		

		$this->view('modules.project.lists');

    }

    public function create() 
	{
		$this->view('modules.project.create', [
			'units' 	 => Unit::all(),
			'pics' 		 => User::pic()->get(),
			'masters' 	 => User::master()->get(),
			'owners' 	 => User::customer()->get()
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

	public function show($id) {
		$project = Project::findOrFail( $id );

		$this->view('modules.project.show', [
			'project' 	 => $project,
		]);
	}

}
