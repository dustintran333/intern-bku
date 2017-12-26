<?php
class MUser extends CI_Model
{
	var $table = 'user';

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

	public function update($id,$data)
	{
		$where = [ "ma_so" => $id ];
		var_dump($data);
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