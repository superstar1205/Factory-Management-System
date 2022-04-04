<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_rows($where, $offset, $limit)
    {
		$sql = "select * from employee_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$sql .= " limit ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function insert_row($insert_data)
	{
		$this->db->insert('employee_tb', $insert_data);
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('employee_tb', $update_data, $id);
	}

	public function delete_row($id)
	{
		$this->db->delete('employee_tb', array('id' => $id));
	}

	function getInfo($id)
    {
		$sql = "select * from employee_tb where id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_count($where)
    {
		$sql = "select count(id) as cnt from employee_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
    }
}