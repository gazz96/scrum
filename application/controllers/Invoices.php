<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\Unit;

use App\Requests\ProjectRequest;

class Invoices extends MY_Controller 
{



	public function __construct() {
		parent::__construct();
	}


    public function index() 
	{
		$this->view('modules.invoice.lists');
    }


}