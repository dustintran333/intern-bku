<?php

/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 21/10/2017
 * Time: 12:46 AM
 */
class MDsdangky extends CI_Model
{
	var $table = 'ds_dang_ky';
	public function __construct()
	{
		$this->load->database();
	}
	public function add($ma_so_sv,$ma_so_dn)
	{
		$this->db->insert($this->table,
			[
				'ma_so_sv' => $ma_so_sv,
				'ma_so_dn' => $ma_so_dn,
			]
		);
	}
	public function delete_by_mssv($id)
	{
		$where = ["ma_so_sv" => $id];
		$this->db->delete($this->table,$where);
	}
	public function delete_by_msdn($id)
	{
		$where = ["ma_so_dn" => $id];
		return $this->db->delete($this->table,$where);
	}
}