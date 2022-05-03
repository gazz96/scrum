<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\User;

class Users extends MY_Controller {

    public function index() {
        $users		= User::when($this->input->get('s'), function($query, $value){
            return $query->where('name', 'like', '%' . $value .'%');
        });

        $users      = $users->get();
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($users);
        $this->output->_display();
        exit;
    }

    public function store() {
        $user 		= User::create($this->input->post(['title', 'project_id']));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($user);
        $this->output->_display();
        exit;
    }

}