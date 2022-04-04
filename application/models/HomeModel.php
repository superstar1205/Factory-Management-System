<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function get_totalSalary($where)
    {
		$sql = "select sum(salary) as cnt from daily_target_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
	
	function get_employeecount($where)
    {
		$sql = "select count(id) as cnt from employee_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}	

	function get_ordercount($where)
    {
		$sql = "select count(id) as cnt from order_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_incomeMoney($where)
    {
		$sql = "select sum(income_value) as cnt from income_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
}