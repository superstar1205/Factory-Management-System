<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemModel extends CI_Model { 

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_rows($where, $offset, $limit)
    {
		$sql = "select * from items_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$sql .= " limit ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_itemrows($where)
    {
		$sql = "select * from items_tb where id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	public function insert_row($insert_data)
	{
		$this->db->insert('items_tb', $insert_data);
	}

	public function update_row($update_data, $id)
	{
		$this->db->update('items_tb', $update_data, $id);
	}

	public function delete_row($id)
	{
		$this->db->delete('items_tb', array('id' => $id));
	}

	function getInfo($id)
    {
		$sql = "select * from items_tb where id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function get_count($where)
    {
		$sql = "select count(id) as cnt from items_tb where id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
    }

	////////////////////////////

	function get_jobrows($where, $offset, $limit)
    {
		$sql = "select jobs_tb.*, items_tb.itemName
				from jobs_tb 
				left join items_tb
				on jobs_tb.item_id = items_tb.id
				where jobs_tb.id > 0 ";
		if($where != ""){
			$sql .= $where;
		}
		$sql .= " limit ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function insert_jobs_row($insert_data)
	{
		$this->db->insert('jobs_tb', $insert_data);
	}

	public function update_jobs_row($update_data, $id)
	{
		$this->db->update('jobs_tb', $update_data, $id);
	}

	public function delete_jobs_row($id)
	{
		$this->db->delete('jobs_tb', array('id' => $id));
	}

	function getJobsInfo($id)
    {
		$sql = "select * from jobs_tb where id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_jobcount($where)
    {
		$sql = "select count(jobs_tb.id) as cnt from jobs_tb 
				left join items_tb
				on jobs_tb.item_id = items_tb.id
		 		where jobs_tb.id > 0 ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if(isset($row["cnt"]))
			return $row["cnt"];
		else
			return 0;
    }

	////////////////////////////	
}