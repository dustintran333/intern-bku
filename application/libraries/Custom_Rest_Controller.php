<?php
/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 01/12/2017
 * Time: 4:46 AM
 */
require(APPPATH.'libraries/REST_Controller.php');
class Custom_Rest_Controller extends \Restserver\Libraries\REST_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mpermission');
		$this->loginProtect();
		$this->authorizeProtect();
		$this->ioProtect();
	}

	/**
	 * Check whether user has logged in
	 */
	public function loginProtect()
	{
		$this->load->model('auth');
		if (!$this->auth->checkLogin()) output401();
	}

	/**
	 * Check whether user is authorized to use current class
	 */
	public function authorizeProtect(){
		$_permission = $this->mpermission->get($this->session->type);
		if(	!$_permission[ $this->router->class ] ) output403();
	}

	/**
		 * 	Check whether user has the right to perform i/o (READ, WRITE)
		 * 	$this->router->method: Get current method name. Official
		 * 	$this->request->method: Get request type like PUT POST DELETE GET. REST_Controller
		 */
	public function ioProtect(){

		$translated_req =
			[
				'get'=>'read',
				'put' => 'write',
				'post' => 'write',
				'delete' => 'write'
			];
		$req = $this->request->method; //Get request type REST_Controller
		$user_permission = $this->mpermission->get( $this->session->type );
		var_dump($user_permission[ $translated_req[ $req ]]);
		if( !$user_permission[ $translated_req[ $req ] ] ) output403();
	}

	/**
	 *	Reload Session data
	 */
	public function reloadSessData(){
		$result =
			$this->db
				->get_where("user",["username" => $this->session->username])
				->row_array();
		$this->session->set_userdata($result);
	}
}