<?php

/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 15/10/2017
 * Time: 10:51 PM
 */
//echo "<pre>";

class Test extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('msinhvien');
		$this->load->model('muser');
		$this->load->model('auth');
	}
	/*Code:
		0: Fail
		1: Success
	*/
	public function prepare_json($data){
		$msg = "Fail";
		$code = 0;

		if($data){
			$msg = "Success";
			$code = 1;
		}

		return compact("msg","code","data"); //create assoc array with key = var names
	}
	public function index(){
		$this->auth->login("sinhvien","123456");
		echo $this->session->username;
		$this->auth->logout();
		echo $this->session->username;
	}
}