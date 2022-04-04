<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('OrdersModel');
		$this->load->model('CommonModel');
	}

	public function index()
	{
		$user_data = $this->session->userdata('gms2020');
        if(empty($user_data) || !isset($user_data["id"]))
			redirect('Auth', 'refresh');

		$msg = '';
		$delBtn = $this->input->post('delBtn', TRUE);
		if($delBtn == "ok"){
			$edit_id = $this->input->post('edit_id', TRUE);

			$update_data = array(
				'isDeleted' => 1
			);
			$this->OrdersModel->update_row($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The inventory has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

		$where = " and order_tb.isDeleted = 0 and order_tb.status = 1";
		$srch_txt = $this->input->post('srch_txt', TRUE);
		if($srch_txt != "")
			$where .= " and order_tb.order_no like '%".$srch_txt."%'";
		
		$list_count = $this->OrdersModel->get_count($where);
		$limit = 10;
		$pagenum = $this->uri->segment(3);
		$pagenum=($pagenum)?($pagenum):1;
		$offset =($pagenum-1)*$limit;
		$configs['uri_segment']=3;

		$configs['base_url'] = base_url().'Inventory/index';
		
		$configs['total_rows'] =$list_count;
		$configs['per_page'] = $limit;
		$no = ($pagenum-1)*$limit+1;

		$pagination = $this->CommonModel->page_all($configs);

		$data['title'] = 'Inventory | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['srch_txt'] = $srch_txt;
		$data["pagination"] = $pagination;
		$data['orders_list'] = $this->OrdersModel->get_rows($where, $offset, $limit);		

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('inventory', $data);
		$this->load->view('template/footer', $data);		
	}

	public function detail()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]))
			redirect('Auth', 'refresh');
		
		$id = $this->input->get('id', TRUE);

		$data['title'] = 'Inventory Detail | G.M.S';
		$data['userdata'] = $user_data;
		
		$data['detail_data'] = $this->OrdersModel->getInfo($id);	

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('inventory-detail', $data);
		$this->load->view('template/footer', $data);		
	}

	public function get_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$inventory_info = $this->OrdersModel->getInfo($edit_id);
		echo(json_encode($inventory_info));
	}
}
