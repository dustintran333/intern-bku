<?php
define("LOGIN_NO_USERNAME",0);
define("LOGIN_SUCCESS",1);
define("LOGIN_WRONG_PASSWORD",2);
define("LOGIN_ALREADY_LOGGED_IN",3);
define("LOGIN_DISABLED_ACCOUNT",4);
class Auth extends CI_Model
{
	var $table = 'user';
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 0: Username not found
	 * 1: Success
	 * 2: Wrong Password
	 * */
	public function checkLogin(){
		return isset($_SESSION['username']);
	}

	/**
	 * Do login and check for error
	 * Retrieve user info and place into Session
	 */
	public function login($username,$password){
		if($this->checkLogin()) return LOGIN_ALREADY_LOGGED_IN;

		$result = $this->db
					->get_where($this->table,["username" => $username])
					->row_array();

		if(!$result) return LOGIN_NO_USERNAME;

		if( $password === $result["password"] )
		{
			if($result["disabled"]) return LOGIN_DISABLED_ACCOUNT;
			$this->session->set_userdata($result);
			return LOGIN_SUCCESS;
		}
		else return LOGIN_WRONG_PASSWORD;
	}

	public function logout(){
		unset($_SESSION);
		$this->session->sess_destroy();
		makeOutput(['msg' => 'Successfully Logged Out', code => 1]);
		//session_write_close();
	}
}
?>