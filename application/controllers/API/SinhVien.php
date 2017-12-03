<?php
/**
 * PURE RESTFUL CONTROLLER
 * User: Phuc
 * Date: 15/10/2017
 * Time: 10:51 PM
 */
/**
 * For PUT/DELETE to work, put in x-www-form-urlencoded
 */
require(APPPATH.'libraries/Custom_Rest_Controller.php');
//use Restserver\Libraries\Custom_Rest_Controller;
define("USERTYPE_ADMIN",0);
define("USERTYPE_ADMIN_DN",1);
define("USERTYPE_DN",2);
define("USERTYPE_SV",3);
class SinhVien extends Custom_Rest_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['msinhvien','muser','mdsdangky','permission']);
		loginProtect();
		// $this->router->method: Get current method name. Official
		// $this->request->method: Get request type like PUT POST DELETE GET. REST_Controller
		$this->authorizeProtect();
	}
	/**
	 * Code:
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
	public function index_get(){
		$id = $this->get('ma_so'); //var_dump($id);
		//var_dump($id);
		$data = $this->prepare_json($this->msinhvien->get_full($id));
		$this->response($data);
		/*
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;*/
	}
	public function index_post(){
		if($_POST){
			$new_sv = [
				"ma_so"=> $this->input->post('ma_so'),
				"ho_ten" => $this->input->post('ho_ten'),
				"sdt" => $this->input->post('sdt'),
				'deadline_chon_dn' => $this->input->post('deadline_chon_dn'),
				'sl_dn_toi_da' => $this->input->post('sl_dn_toi_da'),
			];
			$new_user = [
				"type" => USERTYPE_SV,
				"disabled" => $this->input->post('disabled'),
				"ma_so"=> $this->input->post('ma_so'),
				"username" => $this->input->post('username'),
				"password" => $this->input->post('password'),
				"email" => $this->input->post("email"),
			];
			$this->msinhvien->add($new_sv);
			$this->muser->add($new_user);
			makeOutput();
		}
	}

	public function index_put(){
		if($_POST){
			$id = $this->put("ma_so");
			$new_sv = [
				"ho_ten" => $this->put('ho_ten'),
				"sdt" => $this->put('sdt'),
				'deadline_chon_dn' => $this->put('deadline_chon_dn'),
				'sl_dn_toi_da' => $this->put('sl_dn_toi_da'),
			];
			$new_user = [
				"type" => USERTYPE_SV,
				"disabled" => 0,
				"username" => $this->put('username'),
				"password" => $this->put('password'),
				"email" => $this->put("email"),
			];
			$this->msinhvien->update($id,$new_sv);
			$this->muser->update($id,$new_user);
			makeOutput();
		}
	}
	public function index_delete(){
		$id = $this->delete("ma_so");
		//var_dump($id);die;
		$this->msinhvien->delete($id);
		$this->muser->delete($id);
		$this->mdsdangky->delete_by_mssv($id);
		makeOutput();
		//redirect('sinhvien','refresh');
	}
}