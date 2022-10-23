<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\User;
use Illuminate\Support\Collection;
class Customers extends MY_Controller {

    public function index() {

        $customers = User::with('role')->customer();
        $columns = $this->input->get('columns');
		$customers = $customers->when( $this->input->get('order'), function($query, $value) use( $columns ){
			return $query->orderBy($columns[$value[0]['column']]['name'], $value[0]['dir']);
		}, function( $query ){
            return $query->orderBy('id', 'DESC');
        });

		$customers = $customers->when($this->input->get('search'), function($query, $search){
			return $query->where(function($query) use($search){
                return $query->where('name', 'like', '%' . $search['value'] . '%')
                    ->orWhere('email', 'like', '%' . $search['value'] . '%');
            });
		});

		$customers = $customers->paginate($this->input->get('length', 20), ['*'], 'page', $this->input->get('page'));
        $customersCollections = new Collection($customers);
        $customersCollections->draw = $this->input->get('draw');
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output( $customersCollections );
        $this->output->_display();
        exit;
    }

    public function store() {
        $customer 		= User::create($this->input->post(['name', 'email']) + [
            'role_id' => 4,
        ]);
            
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($customer);
        $this->output->_display();
        exit;
    }

    public function update( $id ) {
        $customer = User::customer()->findOrFail($id);
        $update = $customer->update($this->input->post([
            'name',
            'email',
        ]));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($customer);
        $this->output->_display();
        exit;
    }

    public function delete( $id ) {
        $customer = User::customer()->findOrFail($id);
        $delete = $customer->delete();
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($customer);
        $this->output->_display();
        exit;
    }

    public function show( $id ) {
        $customer = User::customer()->find($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($customer);
        $this->output->_display();
    }

    public function edit( $id ) {
        $card = User::customer()->find($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($card);
        $this->output->_display();
        exit;
    }

}