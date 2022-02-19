<?php 

use Jenssegers\Blade\Blade;
use App\BagiStudio\Middleware;

class MY_Controller extends CI_Controller{

    private $blade;

    public function __construct() {
        parent::__construct();
        $this->blade = new Blade(dirname(__FILE__,2) . '/views', 'cache');
        $this->composer('*', function($view){
            $view->with('body_class', '');
        });
    }

    public function view($view, $data = []) {
        echo $this->blade->make($view, $data)->render();
    }

    public function composer($route, $callback){
        return $this->blade->composer($route, $callback);
    }

    public function middleware($layers = []) {
        return new Middleware($layers);
    }


}