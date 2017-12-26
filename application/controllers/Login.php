<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
	}
	public function index(){
		$this->handleLoginResult(
			$this->auth->login(
				$this->input->post('username'),
				$this->input->post('password')
			)
		);
	}
	public function view_user(){
		makeOutput( $this->session->get_userdata() );
	}
	/**
	 * Handle Possible Login Cases (for Login Controller)
	 */
	private function handleLoginResult($res){
		switch ($res){
			case LOGIN_NO_USERNAME: makeOutput(["msg" => "No Username Found", "code" => $res]);break;
			case LOGIN_SUCCESS: makeOutput(["msg" => "Login Successful", "code" => $res]);break;
			case LOGIN_WRONG_PASSWORD: makeOutput(["msg" => "Wrong Password", "code" => $res]);break;
			case LOGIN_ALREADY_LOGGED_IN: makeOutput(["msg" => "You Are Already Logged In", "code" => $res]);break;
			case LOGIN_DISABLED_ACCOUNT: makeOutput(["msg" => "Your Account Is Disabled", "code" => $res]);break;
		}
	}
	public function logout(){
		$this->auth->logout();
	}
}