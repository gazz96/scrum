<?php

namespace App\BagiStudio;

use Rakit\Validation\Validator;


class FormValidation extends Validator {

    protected $redirect = '';
    protected $validation;
	protected $request;

    public function __construct() {
		$this->request = $_POST + $_GET + $_FILES;
        $this->registerBaseValidators();
        $this->run();
    }

    protected function authorize() {
        return true;
    }

    protected function rules() {
        return [];
    }

    protected function messages() {
        return [];
    }

    protected function attributes() {
        return [];
    }

    protected function prepareForValidation() {
        return [];
    }

    public function validated() {
        return $this->validation->getValidatedData();
    }

    public function errors() {
        $errors = $this->validation->errors();
        return $errors->firstOfAll();
    }

    public function run() {

        if( ! $this->authorize() ) return false;

        $this->validation = $this->make($_POST + $_FILES, $this->rules());
        $this->validation->setAliases( $this->attributes() );
        $this->validation->setMessages( $this->messages() );
        $this->validation->validate();

        if( $this->validation->fails() )  {
            session()->set_flashdata( 'errors', $this->errors() );
            return back();
        }

    }

    public function addNewValidator($name, $class_name ) {
        $this->addValidator( $name, $class_name );
    }

}
