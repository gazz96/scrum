<?php 

namespace App\Requests;

use App\BagiStudio\FormValidation;

class UserRequest extends FormValidation
{

	public function rules() 
	{

		$rules = [
			'name' => 'required',
			'email' => 'required',
			'userpass' => 'required',
			'role_id' => 'required'
		];

		if( request('true_submit') == "update") 
		{
			$rules['userpass'] = 'nullable';
		}

		return $rules;

	}	

}
