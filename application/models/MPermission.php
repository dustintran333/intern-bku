<?php
class MPermission extends CI_Model
{
	var $table = 'permission';
	public function __construct()
	{
		$this->load->database();
	}
	public function get($type = NULL){
		$db = &$this->db;
		$db	-> from($this->table)
			-> where($type?['type' => $type]:"");
		return $type ? $db->get()->row_array() : $db->get()->result_array();
	}

}
?>