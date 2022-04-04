<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SalaryModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_rows($where)
    {
		$sql =      
        "SELECT salary_tb.*, order_tb.order_no, daily_target_tb.customer AS customer_name, jobs_tb.job AS job_name
		FROM salary_tb
		LEFT JOIN order_tb ON salary_tb.order_id = order_tb.id
		LEFT JOIN jobs_tb ON salary_tb.job_id = jobs_tb.id
		LEFT JOIN daily_target_tb ON jobs_tb.id = daily_target_tb.job_id
		WHERE salary_tb.id > 0  AND salary_tb.isDeleted = 0";
          
		if($where != ""){
			$sql .= $where;
		}
		$query =$this->db->query($sql);
    	return $query->result_array();
	}

	function get_re_rows($id, $srch_year, $srch_month){
		$sql = "SELECT tt.customer_name, SUM(tt.completed_piece) AS cp, SUM(tt.order_payment) AS op FROM (SELECT salary_tb.*, order_tb.order_no, daily_target_tb.customer AS customer_name, jobs_tb.job AS job_name
		FROM salary_tb
		LEFT JOIN order_tb ON salary_tb.order_id = order_tb.id
		LEFT JOIN jobs_tb ON salary_tb.job_id = jobs_tb.id
		LEFT JOIN daily_target_tb ON jobs_tb.id = daily_target_tb.job_id
		WHERE salary_tb.id > 0  AND salary_tb.isDeleted = 0 AND salary_tb.employee_id = ".$id." AND salary_tb.calc_year = ".$srch_year." AND salary_tb.calc_month = ".$srch_month." GROUP BY salary_tb.id)tt GROUP BY customer_name ORDER BY op DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function insert_row($insert_data)
	{
		$this->db->insert('salary_tb', $insert_data);
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('salary_tb', $update_data, $id);
	}

	public function delete_row($id)
	{
		$this->db->delete('salary_tb', array('id' => $id));
	}

	function getInfo($id)
    {
		$sql = "select * from salary_tb where id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_count($where)
    {
		$sql = "select count(salary_tb.id) as cnt
				from salary_tb
				left join order_tb on salary_tb.order_id = order_tb.id
				where salary_tb.id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
	
	function get_paid_amount($where)
    {
		$sql = "select sum(salary_tb.order_payment) as cnt
				from salary_tb
				left join order_tb on salary_tb.order_id = order_tb.id
				where salary_tb.id > 0 and salary_tb.status = 1".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_unpaid_amount($where)
    {
		$sql = "select sum(salary_tb.order_payment) as cnt
				from salary_tb
				left join order_tb on salary_tb.order_id = order_tb.id
				where salary_tb.id > 0 and salary_tb.status = 0".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_total_amount($where)
    {
		$sql = "select sum(salary_tb.order_payment) as cnt
				from salary_tb
				left join order_tb on salary_tb.order_id = order_tb.id
				where salary_tb.id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
}