<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProcessModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	///////////////////////////////////////////
		/* Daily Target */ 
	///////////////////////////////////////////

	function get_rows($where, $offset, $limit)
    {
		$sql = "select daily_target_tb.*, employee_tb.name, order_tb.order_no, jobs_tb.job 
				from daily_target_tb 
				left join employee_tb on daily_target_tb.employee_id = employee_tb.id
				left join order_tb on daily_target_tb.order_id = order_tb.id
				left join jobs_tb on daily_target_tb.job_id = jobs_tb.id
				where daily_target_tb.id > 0 ".$where." order by order_tb.order_no desc";
		$sql .= " limit ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function insert_row($insert_data)
	{
		$this->db->insert('daily_target_tb', $insert_data);
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('daily_target_tb', $update_data, $id);
	}

	public function delete_row($id)
	{
		$this->db->delete('daily_target_tb', array('id' => $id));
	}

	function getInfo($id)
    {
		$sql = "select daily_target_tb.*, jobs_tb.job as job_name
				from daily_target_tb 
				left join jobs_tb on daily_target_tb.job_id = jobs_tb.id
				where daily_target_tb.id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_count($where)
    {
		$sql = "select count(id) as cnt from daily_target_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
	
	function get_orderNo_rows($where)
    {
		$sql = "select * from order_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_orderNo_row($order_no)
    {
		$sql = "select * from order_tb where order_no = '".$order_no."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function get_employee_row($emplyee_name)
    {
		$sql = "select * from employee_tb where name = '".$emplyee_name."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_employee_rows($where)
    {
		$sql = "select * from employee_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jobs_rows($where)
    {
		$sql = "select * from jobs_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_cost_row($where)
    {
		$sql = "select cost as cnt from order_detail_tb where id >0".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
	
	function getOrderInfo($id)
    {
		$sql = "select order_tb.*, jobs_tb.id as job_id, jobs_tb.job as job_name
				from order_tb
				left join jobs_tb on order_tb.order_item = jobs_tb.item_id
				where order_tb.id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function getTcpInfo($order_no, $job)
	{
		$sql = "SELECT daily_target_tb.*, jobs_tb.id AS job_id, jobs_tb.job AS job, employee_tb.name AS e_name, SUM(daily_target_tb.completed_piece) AS t_cp FROM daily_target_tb  LEFT JOIN employee_tb ON daily_target_tb.employee_id = employee_tb.id LEFT JOIN order_tb ON daily_target_tb.order_id = order_tb.id LEFT JOIN jobs_tb ON daily_target_tb.job_id = jobs_tb.id WHERE order_tb.order_no = '".$order_no."' And jobs_tb.job ='".$job."' AND daily_target_tb.id > 0 AND daily_target_tb.isDeleted = 0 GROUP BY employee_tb.name ORDER BY t_cp DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_completed_count($where)
    {
		$sql = "select sum(completed_piece) as cnt from daily_target_tb where id > 0 ".$where." group by order_id";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_order_completed_count($where)
    {
		$sql = "select completed_quantity as cnt from order_detail_tb".$where." group by order_id";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
}