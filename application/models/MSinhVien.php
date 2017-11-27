<?php

/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 21/10/2017
 * Time: 12:46 AM
 */
class MSinhVien extends CI_Model
{
	var $table = 'sinh_vien';
	public function __construct()
	{
		$this->load->database();
	}
	public function get($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get($this->table);
			return $query->result_array(); //multiple results
		}
		$query = $this->db->get_where($this->table, ['ma_so' => $id]);
		return $query->row_array(); //single result
	}
	public function get_full()
	{
		$db = &$this->db;
		$db->select();
		$db->from("sinh_vien");
		$db->join("user","sinh_vien.ma_so = user.ma_so");
		return $db->get()->result_array();
	}
	public function update($id,$data)
	{
		$where = [ "ma_so" => $id ];
		$this->db->update($this->table,$data,$where);
	}
	public function add($data)
	{
		$this->db->insert($this->table,$data);
	}
	public function delete($id)
	{
		$where = ["ma_so" => $id];
		$this->db->delete($this->table,$where);
	}
}