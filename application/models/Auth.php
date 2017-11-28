<?php
/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 27/11/2017
 * Time: 12:14 PM
 */
define("LOGIN_NO_USERNAME",0);
define("LOGIN_SUCCESS",1);
define("LOGIN_WRONG_PASSWORD",2);
define("LOGIN_ALREADY_LOGGED_IN",0);
class Auth extends CI_Model
{
	var $table = 'user';
	public function __construct()
	{
		$this->load->database();
	}
	/*
	 * 0: Username not found
	 * 1: Success
	 * 2: Wrong Password
	 * */
	public function checkLogin(){
		return isset($_SESSION['username']);
	}
	public function login($username,$password){
		if(isset($_SESSION['username'])) return LOGIN_ALREADY_LOGGED_IN;
		$result =
			$this->db->get_where($this->table,["username" => $username])
			->row_array();
		if(!$result["password"]) return LOGIN_NO_USERNAME;
		if($password == $result["password"] )
		{
			$this->session->set_userdata($result);
			return LOGIN_SUCCESS;
		}
		else return LOGIN_WRONG_PASSWORD;
	}
	public function logout(){
		unset($_SESSION);
		$this->session->sess_destroy();
		//session_write_close();
	}
	public function checkAuth(){

	}
}
?>