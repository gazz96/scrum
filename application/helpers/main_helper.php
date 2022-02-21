<?php 

function request( $names  = "" ) {
    $CI =& get_instance();

    if( ! $names ) return $CI->input->post() + $CI->input->get();

    return $CI->input->post_get( $names );

}

function back() {
    $CI =& get_instance();
    return redirect($CI->agent->referrer());
}

function session() {
    $CI =& get_instance();
    return $CI->session;
}

function dd( $data ) {
    echo "<pre>";
    var_dump( $data );
    echo "</pre>";
    die();
}

function router() {
    $CI =& get_instance();
    return $CI->router;
}

function config() {
    $CI =& get_instance();
    return $CI->config;
}


function auth() {
    return App\Services\AuthService::getInstance();
}


function errors( $name = '' ) {

    $errors = session()->flashdata('errors');
    
    if( isset($errors[$name]) ) return $errors[$name];

    if( ! $errors ) return [];
    
    return $errors;
    
}

function selected($value, $compared) {
	if( $value == $compared ) {
		return "selected";
	}

	return "";
}
