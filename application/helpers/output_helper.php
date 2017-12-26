<?php
/**
 * Print 401 Not Logged In
 */
function output401(){

	$ci =& get_instance();
	$ci->output
		->set_status_header(401)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode(["msg" => "Not Logged In","code" => 401], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
	die;
}

/**
 * Print 403 no permission
 */
function output403(){

	$ci =& get_instance();
	$ci->output
		->set_status_header(403)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode(["msg" => "Forbidden: You Don't Have Permission","code" => 403], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
	die;
}

/**
 * Make full output JSON for a given $data
 */
function makeOutput($data = ['msg' => 'Success', 'code' => 1]){

	$ci =& get_instance();
	$ci->output
		->set_status_header(200)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
	die;
}

?>