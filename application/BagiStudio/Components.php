<?php

namespace App\BagiStudio;

use Jenssegers\Blade\Blade;

class Components {
    
    protected $blade;

    public function __construct(...$props) 
    {
        $this->blade = new Blade(dirname(__FILE__,2) . '/views', 'cache');
    }

}