<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Card;
use App\Models\CardItem;

use App\BagiStudio\DurianPay;

class Payment extends MY_Controller {

    private $durianPay;

    public function __construct() {
        $this->durianPay = new DurianPay;
    }


    public function create() {
        $data = [
            'amount' => "1000000",
            'currency' => 'IDR',
            'is_payment_link' => true,
            'customer' => [
                'customer_ref_id' => 'cust_001',
                'email' => 'bagas.topati@gmail.com',
                'mobile' => '895611508388',   
            ]
        ];
        $response = $this->durianPay->createOrder($data);
        echo $response->getBody();
        // $this->output->set_status_header(200);
        // $this->output->set_content_type('application/json', 'utf-8');
        // $this->output->set_output($response->getBody());
        // $this->output->_display();
        exit;
    }
}