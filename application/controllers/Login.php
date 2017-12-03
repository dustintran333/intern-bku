<?php
class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
	}
	public function index(){
		handleLogin(
			$this->auth->login(
				$this->input->post("username"),
				$this->input->post("password")
			)
		);
	}
	public function logout(){
		$this->auth->logout();
	}
}