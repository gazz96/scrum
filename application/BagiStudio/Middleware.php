<?php

namespace App\BagiStudio;

use Optimus\Onion\Onion;

class Middleware extends Onion {

    private $methods = [];

    private $is_run = false;

    public function __construct( $layers = [] ) {
        parent::__construct( $layers ); 
        config()->load('middleware');
    }


    public function only( $methods ) {
        if( in_array(router()->fetch_method(), $methods ) ) {
            $this->run();
        }
    }

    public function except( $methods ) {
        if( ! in_array(router()->fetch_method(), $methods ) ) {
            $this->run();
        }
    }

    public function run() {

        $web = config()->item('middleware')['web'];
    
        $this->layer( $web )
        ->peel( get_instance(), function($object){
            return $object;
        });

    }

}