<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_rows($where, $offset, $limit)
    {
		$sql = "select order_tb.*, items_tb.itemName, items_tb.id as item_id, jobs_tb.job
				from order_tb
				left join items_tb on order_tb.order_item = items_tb.id
				left join jobs_tb on order_tb.order_item = jobs_tb.item_id
				where order_tb.id > 0 ".$where." group by order_tb.order_no order by order_tb.id desc";
		$sql .= " limit ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function insert_row($insert_data)
	{
		$this->db->insert('order_tb', $insert_data);
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('order_tb', $update_data, $id);
	}

	function getInfo($id)
    {
		$sql = "select order_tb.*, items_tb.itemName, items_tb.id as item_id, jobs_tb.job
				from order_tb
				left join items_tb on order_tb.order_item = items_tb.id
				left join jobs_tb on order_tb.order_item = jobs_tb.item_id
				where order_tb.id > 0 and order_tb.id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_count($where)
    {
		$sql = "select count(id) as cnt from order_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}

	function get_max_row($where)
    {
		$sql = "select max(order_no) as cnt from order_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
	
	function get_item_rows($where)
    {
		$sql = "select * from items_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	//////////////////////////////////////////////////////
					/* Order Detail */
	//////////////////////////////////////////////////////

	function get_detailrows($where)
    {
		$sql = "select order_detail_tb.*, jobs_tb.job
				from order_detail_tb				
				left join jobs_tb on order_detail_tb.job_id = jobs_tb.id
				where order_detail_tb.id > 0 and order_detail_tb.isDeleted = 0".$where;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function insert_detailrow($insert_data)
	{
		$this->db->insert('order_detail_tb', $insert_data);
	}

	public function update_detailrow($update_data, $id)
	{
		$this->db->update('order_detail_tb', $update_data, $id);
	}

	function getDetailInfo($id)
    {
		$sql = "select order_detail_tb.*, jobs_tb.job
				from order_detail_tb				
				left join jobs_tb on order_detail_tb.job_id = jobs_tb.id
				where order_detail_tb.id > 0 and order_detail_tb.id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function get_order_detail_rows($where)
    {
		$sql = "select * from order_detail_tb".$where;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function get_order_no($where)
    {
		$sql = "select order_no from order_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["order_no"]))
			return $row["order_no"];
		else
			return "";
	}

	function get_job_rows($where)
    {
		$sql = "select * from jobs_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_accessoryrows($where)
    {
		$sql = "select * from order_accessories_tb where id > 0 and isDeleted = 0".$where;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function insert_accessoryrow($insert_data)
	{
		$this->db->insert('order_accessories_tb', $insert_data);
	}

	public function update_accessoryrow($update_data, $id)
	{
		$this->db->update('order_accessories_tb', $update_data, $id);
	}

	function getAccessoryInfo($id)
    {
		$sql = "select * from order_accessories_tb where id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function get_accessorycost($where)
    {
		$sql = "select sum(cost) as cnt from order_accessories_tb where id > 0 and isDeleted = 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
	}
}