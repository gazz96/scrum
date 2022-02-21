<?php 

namespace App\Requests;

use App\BagiStudio\FormValidation;

class UnitRequest extends FormValidation 
{

	public function rules() 
	{
		return [
			'name' => 'required',
		];
	}	

}
