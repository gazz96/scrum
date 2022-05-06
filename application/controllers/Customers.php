<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\User;
use App\Models\Role;

use App\Requests\UserRequest;

class Customers extends MY_Controller 
{

	public function __construct() {
		parent::__construct();
	}


	

    public function index() 
	{
		$this->view('modules.customer.list');

    }

    

}
