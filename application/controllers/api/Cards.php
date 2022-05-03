<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Card;

class Cards extends MY_Controller {

    public function index() {
        $cards		= Card::where('project_id', $this->input->get('project_id'))->get();
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($cards);
        $this->output->_display();
        exit;
    }

    public function store() {
        $card 		= Card::create($this->input->post(['title', 'project_id']));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($card);
        $this->output->_display();
        exit;
    }

}