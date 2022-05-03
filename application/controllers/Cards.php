<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\Unit;
use App\Models\Card;

use App\Requests\ProjectRequest;

class Cards extends MY_Controller 
{



	public function __construct() {
		parent::__construct();
	}

	

    public function index() 
	{
	
		$this->view('modules.card.list');

    }

    public function create() 
	{
		$this->view('modules.card.create', [
			'units' 	 => Unit::all(),
			'pics' 		 => User::pic()->get(),
			'masters' 	 => User::master()->get(),
			'owners' 	 => User::owner()->get()
		]);
    }

    public function store() 
	{
		
		$card 		= Card::create($this->input->post(['title', 'project_id']));
        $this->output->set_output($card);
        $this->output->_display();
        exit;
    }

    public function edit( $id ) 
	{
		$card = Card::findOrFail( $id );
		$this->view('modules.project.edit', [
            'card' => $card
		]);
    }

    public function update( $id ) 
	{
		//$request 	= new ProjectRequest;
		$data 		= [];	
		$card 	= Card::findOrFail( $id );
		$card->update( $data );
		
		$this->session->set_flashdata('message', 'Berhasil memperbaharui');
		redirect(base_url('/cards/edit/' . $id ));
    }

    public function delete( $id ) {
        $project = Project::findOrFail( $id );
		$project->delete();
		back();
    }

}
