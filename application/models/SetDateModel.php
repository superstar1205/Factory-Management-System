<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SetDateModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_row()
    {
		$sql = "select * from date_tb where id = 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('date_tb', $update_data, $id);
	}

	function getInfo($id)
    {
		$sql = "select * from date_tb where id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
}