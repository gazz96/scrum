<?php 

namespace App\Requests;

use App\BagiStudio\FormValidation;

class ProjectRequest extends FormValidation 
{

	public function rules() 
	{
		$rules = [
			"name" 		=> "required",
			"unit_id" 	=> "required", 
			"master_id" => "required",
			"pic_id" 	=> "required",
			"owner_id" 	=> "required",
			"status" 	=> "required"
		];
		return $rules;
	}	

}
