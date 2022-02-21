<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use App\Models\User;


class AuthService {

    private static $_instance = null;

    private $key = "MIIBVAIBADANBgkqhkiG9w0BAQEFAASCAT4wggE6AgEAAkEAtkkO5Txeztqf1fKxe3lQWCOLm";

    private $payload;

    public function generateToken( $algo = "HS256" ) {
        return JWT::encode($this->payload, $this->key, $algo);
    }

    public function setPayload(  $payload ) {
        $this->payload = $payload;
        return $this;
    }

    public function getPayload() {
        return $this->payload;
    }

    public function setKey( $key ) {
        $this->key = $key;
        return $this;
    }

    public function getKey() {
        return $this->key;
    }

    public function verify( $token, $algo = "HS256" ) {  
        try{
            return JWT::decode( $token, new Key($this->key, $algo));
        }catch( \Exception $e ){
            return false;
        }
    }

    public function check( $algo = "HS256" ) {
        try{
            return JWT::decode( $this->getToken(), new Key($this->key, $algo));
        }catch( \Exception $e ){
            return false;
        }
    }

    public function getToken() {
        $ci =& get_instance();
        return $ci->session->userdata('token');
    }

    public function user() {
        
        //dd( $this->getToken() );
        $verify = $this->verify( $this->getToken() );

        //dd( $verify ); 
        
        if( !$verify ) return false;

        return User::findOrFail( $verify->uid ?? '');

    }

    public function ID() {
        $verify = $this->verify( $this->getToken() );
        if( !$verify ) return false;
        return $verify->uid;
    }

    public static function getInstance() {

        if(!self::$_instance) self::$_instance = new AuthService;

        return self::$_instance;
    }

    public function attempt($data) {

    }

    public function destroy( ) {
        session()->unset_userdata('token');
    }

}
