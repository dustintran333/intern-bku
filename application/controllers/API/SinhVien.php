<?php

/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 15/10/2017
 * Time: 10:51 PM
 */
//echo "<pre>";
require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class SinhVien extends REST_Controller
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
	public function index_get(){
		$id = $this->get('id'); //var_dump($id);
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
	public function edit($id){
		if($_POST){
			$new_data = [
			 	"ho_ten" => $this->input->post("txt_ho_ten"),
				"username" => $this->input->post("txt_username"),
				"password" => $this->input->post("txt_password"),
				"sdt" => $this->input->post("txt_sdt"),

				"disabled" => $this->input->post("enable"),
				"deadline_ung_tuyen" => $this->input->post(),
				"deadline_chon_dn" => $this->input->post("deadline2"),
			];
			$this->msinhvien->update($id,$new_data);
		}
		$data["sv"] = $this->msinhvien->get($id);
	}
	public function add(){
		if($_POST){
			$new_sv = [
				"ma_so"=> $this->input->post('ma_so'),
				"ho_ten" => $this->input->post('ho_ten'),
				"sdt" => $this->input->post('sdt'),
			];
			$new_user = [
				"username" => $this->input->post('username'),
				"password" => $this->input->post('password'),
				"type" => 1,
				"email" => $this->input->post("email"),
				"disabled" => 0,
			];
			$this->msinhvien->add($new_sv);
			$this->muser->add($new_user);
		}
	}
	public function delete($id){
		$this->msinhvien->delete($id);
		$this->muser->delete($id);
		$this->mdsdangky->delete_by_mssv($id); //await implementation
		//redirect('sinhvien','refresh');
	}
}