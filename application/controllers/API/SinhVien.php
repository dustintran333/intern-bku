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
/**
 * Auto Loaded:
 * 	 helper: url_helper, url, output_helper
 * 	 libraries: session
 */
require(APPPATH.'libraries/Custom_Rest_Controller.php');
define("USERTYPE_ADMIN",0);
define("USERTYPE_ADMIN_DN",1);
define("USERTYPE_DN",2);
define("USERTYPE_SV",3);
class SinhVien extends Custom_Rest_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['msinhvien','muser','mdsdangky']);
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

	public function index_get(){ //	GET SINGLE/ALL SINHVIEN (without ma_so)
		$id = $this->get('ma_so');
		$data = $this->prepare_json($this->msinhvien->get_full($id));
		$this->response($data);
		/**
		 * Prev output code
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
		 */
	}

	public function index_post(){ // CREATE NEW SINHVIEN + USER
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$frmCheck = &$this->form_validation;

		if( $frmCheck->run('sinhvien_create') )
		{
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
		else
		{
			makeOutput([
				'msg' => $frmCheck->error_array(),
				'code' => 0
			]);
		}
	}

	public function index_put(){ // UPDATE SINHVIEN with ma_so
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$frmCheck = &$this->form_validation;

		//Fetch data from put
		$id = $this->put("ma_so");
		$update_user = [
			"type" => USERTYPE_SV,
			"disabled" => $this->put('disabled'),
			"username" => $this->put('username'),
			"password" => $this->put('password'),
			"email" => $this->put("email"),
		];
		$update_sv = [
			"ho_ten" => $this->put('ho_ten'),
			"sdt" => $this->put('sdt'),
			'deadline_chon_dn' => $this->put('deadline_chon_dn'),
			'sl_dn_toi_da' => $this->put('sl_dn_toi_da'),
		];
		$frmCheck->set_data( [ 'ma_so' => $id ] + $update_sv + $update_user);

		if( $frmCheck->run('sinhvien_update') )
		{
			$update_user = array_filter($update_user);
			$update_sv = array_filter($update_sv);
			var_dump($update_sv,$update_user);
			if($update_user) $this->muser->update($id, $update_user);
			if($update_sv) $this->msinhvien->update($id, $update_sv);

			makeOutput();
		}
		else
		{
			makeOutput([
				'msg' => $frmCheck->error_array(),
				'code' => 0
			]);
		}
	}

	public function index_delete(){// DELETE SINHVIEN + user with ma_so
		$id = $this->delete("ma_so");
		$this->msinhvien->delete($id);
		$this->muser->delete($id);
		$this->mdsdangky->delete_by_mssv($id);
		makeOutput();
	}
}