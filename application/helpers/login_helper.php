<?php
/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 28/11/2017
 * Time: 11:08 PM
 */
function loginProtect()
{
	$ci =& get_instance();
	$ci->load->model('auth');
	if (!$ci->auth->checkLogin()){
		output401();
	}
}
function output401(){
	$ci =& get_instance();
	$ci->output
		->set_status_header(401)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode(["msg" => "Not Logged In","code" => 401], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
	die;
}
function output403(){
	$ci =& get_instance();
	$ci->output
		->set_status_header(403)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode(["msg" => "Forbidden: You Don't Have Permission","code" => 403], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
	die;
}
function makeOutput($data = ['msg' => 'Success', 'code' => 1]){
	$ci =& get_instance();
	$ci->output
		->set_status_header(200)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
	die;
}
function handleLogin($res){
	switch ($res){
		case LOGIN_NO_USERNAME: makeOutput(["msg" => "No Username Found", "code" => $res]);break;
		case LOGIN_SUCCESS: makeOutput(["msg" => "Login Successful", "code" => $res]);break;
		case LOGIN_WRONG_PASSWORD: makeOutput(["msg" => "Wrong Password", "code" => $res]);break;
		case LOGIN_ALREADY_LOGGED_IN: makeOutput(["msg" => "You Are Already Logged In", "code" => $res]);break;
	}
}
?>