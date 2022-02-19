<?php 

namespace App\BagiStudio; 

class Request {

    public function __construct() {
    }


    public function all() {
        return $_GET + $_POST + $_FILES;
    }

    public function hasFile( $name ) {
        if( isset( $_GET[$name] ) ) {
            return true;
        }
        return false;
    }

    public function file($name) {
        if( isset($_FILES[$name]) ){
            return $_FILES[$name];
        }
        return $this;
    }


    public function move($path, $name) {

    }

}