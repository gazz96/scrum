<?php 

namespace App\BagiStudio;

use GuzzleHttp\Client;

class DurianPay {

    private $url = "https://api.durianpay.id/v1";
    private $serverKey = "dp_test_vREzLUGtnDLSDvpi";

    private $http;

    private function getServerKey() {
        return base64_encode('bagas.topati@gmail.com');
    }

    public function __construct() {
        $this->http = new Client([
            'base_uri' => $this->url,
            'verify' => false,
        ]);
    }


    public function createOrder($data = []) {
        $response = $this->http->request('POST','/orders', [
            'headers' => [
               
            ],
            'auth' => [$this->serverKey, ''],
            'json' => $data
        ]);

        return $response;
    }

}