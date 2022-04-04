<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class IncomeModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_rows($where, $offset, $limit)
    {
		$sql = "select * from income_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$sql .= " limit ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function insert_row($insert_data)
	{
		$this->db->insert('income_tb', $insert_data);
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('income_tb', $update_data, $id);
	}

	function getInfo($id)
    {
		$sql = "select * from income_tb where id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_count($where)
    {
		$sql = "select count(id) as cnt from income_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
	
	function get_orderIncome($where)
    {
		$sql = "select sum(order_income) as cnt from order_tb where id > 0 and isDeleted = 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_employeeSalary($where)
    {
		$sql = "select sum(salary) as cnt from daily_target_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_accessoryCost($where)
    {
		$sql = "select sum(accessory_cost) as cnt from order_tb where id > 0 and isDeleted = 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_graph_rows($where)
    {
		$sql = "select * from income_tb where id > 0".$where;
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}