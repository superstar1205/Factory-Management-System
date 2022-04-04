<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_row($where)
    {
		$sql = "select * from user_tb".$where;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('user_tb', $update_data, $id);
	}	
}