<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Invoice;
use App\Models\InvoiceItem;

use Illuminate\Support\Collection;
class Invoices extends MY_Controller {

    public function index() {
        $invoices		= Invoice::quer();
        $invoices       = $invoices->paginate(20);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output(new Collection($invoices));
        $this->output->_display();
        exit;
    }

    public function store() {
        $invoice = Invoice::create($this->input->post([
            'project_id', 
            'order_code',
            'issue_date',
            'due_date',
            'customer_id',
        ]));
            
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output($invoice);
        $this->output->_display();
        exit;
    }

    public function update( $id ) {
        $invoice = InvoiceItem::findOrFail($id);
        $update = $invoice->update($this->input->post([
            'name',
            'description',
            'status'
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

}