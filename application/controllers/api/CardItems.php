<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\CardItem;
use App\Models\Card;

class CardItems extends MY_Controller {

    public function index() {
        $cards		= CardItem::where('card_id', $this->input->get('card_id'))->get();
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($cards);
        $this->output->_display();
        exit;
    }

    public function store() {
        $card 		= CardItem::create($this->input->post(['card_id', 'name', 'description']));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($card);
        $this->output->_display();
        exit;
    }

    public function edit( $id ) {
        $card = CardItem::find($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($card);
        $this->output->_display();
        exit;
    }

    public function update( $id ) {
        $card = CardItem::findOrFail($id);
        $update = $card->update($this->input->post([
            'name',
            'description',
            'status'
        ]));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($card);
        $this->output->_display();
        exit;
    }

    public function delete( $id ) {
        $card = CardItem::findOrFail($id);
        $delete = $card->delete();
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($delete);
        $this->output->_display();
        exit;
    }

   

}