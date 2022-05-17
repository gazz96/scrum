<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Invoice;
use App\Models\InvoiceItem;

use Illuminate\Support\Collection;

class Invoices extends MY_Controller {

    public function index() {
        $invoices = Invoice::with('customer');
        $columns = $this->input->get('columns');

		$invoices = $invoices->when( $this->input->get('order'), function($query, $value) use( $columns ){
			return $query->orderBy($columns[$value[0]['column']]['name'], $value[0]['dir']);
		}, function( $query ){
            return $query->orderBy('id', 'DESC');
        });

        $invoices = $invoices->when($this->input->get('project_id'), function($query, $project_id){
            return $query->where('project_id', $project_id);
        });

		$invoices = $invoices->when($this->input->get('search')['value'] ?? '', function($query, $search){
			return $query->where(function($query) use ($search){
                return $query->orWhereHas('project',function($query) use($search){
                    $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas ('customer', function($query) use($search){
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
		});

        $invoices = $invoices->when($this->input->get('status'), function($query, $status){
            return $query->where('status', $status);
        });

		$invoices = $invoices->paginate($this->input->get('length', 20), ['*'], 'page', $this->input->get('page'));
        $invoicesCollections = new Collection($invoices);
        $invoicesCollections->draw = $this->input->get('draw');

        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($invoicesCollections);
        $this->output->_display();
        exit;
    }

    public function store() {
        $invoice = Invoice::create($this->input->post([
            'customer_id', 
            'project_id',
            'order_code',
            'issue_date',
            'due_date',
            'status',
            'total_amount'
        ]));
            
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($invoice);
        $this->output->_display();
        exit;
    }

    public function update( $id ) {
        $invoice = Invoice::findOrFail($id);
        $update = $invoice->update($this->input->post([
            'customer_id', 
            'project_id',
            'order_code',
            'issue_date',
            'due_date',
            'status',
            'total_amount'
        ]));
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($invoice);
        $this->output->_display();
        exit;
    }

    public function delete( $id ) {
        $invoice = Invoice::findOrFail($id);
        $delete = $invoice->delete();

        $invoice_items = InvoiceItem::where('invoice_id', $id)->delete();

        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($invoice);
        $this->output->_display();
        exit;
    }

    public function show( $id ) {
        $invoice = Invoice::with('customer')->findOrFail($id);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($invoice);
        $this->output->_display();
        exit;
    }

    public function total( $project_id ) {
        $total_invoice = Invoice::where('project_id', $project_id)->sum('total_amount');
        $paided_invoice = Invoice::where('project_id', $project_id)->where('status', 'Paid')->sum('total_amount');
 
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output(json_encode([
            'total_invoice' => $total_invoice,
            'paided_invoice' => $paided_invoice
        ]));
        $this->output->_display();
        exit; 
    }
    

}