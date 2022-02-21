<?php 

namespace App\BagiStudio;

class Form 
{
	public static function text( $id, $label, $value = "" ){
		$attrib = [
			'name'          => $id,
			'id'            => 'i-' . $id,
			'value'         => $value,
			'class'			=> "form-control"
		];

		return "
			<div class='form-group'>" . form_label($label, 'i-'.$id) . form_input( $attrib ) ."</div>
		";
	}
 
}
