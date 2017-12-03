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
	}
	public function authorizeProtect(){
		$map = ['get'=>'read','put' => 'write','post' => 'write','delete' => 'write'];
		$req_type = $this->request->method;
		$user_permission = $this->permission->get($this->session->type);
		if( !$user_permission[ $map[ $req_type ] ] ) output403();
	}
}