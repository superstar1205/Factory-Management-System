<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('ItemModel');
		$this->load->model('CommonModel');
	}

	public function index()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]))
			redirect('Auth', 'refresh');

		$msg = '';			
		$saveBtn = $this->input->post('saveBtn', TRUE);
		if($saveBtn == "ok"){
			$itemName = $this->input->post('itemName', TRUE);

			$insert_data = array(
				'itemName' => $itemName,				
				'created_at' => date('Y-m-d H:i:s')
			);

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){
				$this->ItemModel->update_row($insert_data, array('id' => $add_id));
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						The Item has been updated successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}else{
				$this->ItemModel->insert_row($insert_data);
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						New Item has been added successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}
		}

		$delBtn = $this->input->post('delBtn', TRUE);
		if($delBtn == "ok"){
			$edit_id = $this->input->post('edit_id', TRUE);

			$update_data = array(
				'isDeleted' => 1
			);
			$this->ItemModel->update_row($update_data, array('id' => $edit_id));

			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					New Item has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

		$where = " and isDeleted = 0";	

		$srch_txt = $this->input->post('srch_txt', TRUE);
		if($srch_txt != "")
			$where .= " and itemName like '%".$srch_txt."%'";
		
		$list_count = $this->ItemModel->get_count($where);
		$limit = 10;
		$pagenum = $this->uri->segment(3);
		$pagenum=($pagenum)?($pagenum):1;
		$offset =($pagenum-1)*$limit;
		$configs['uri_segment']=3;

		$configs['base_url'] = base_url().'Items/index';
		
		$configs['total_rows'] =$list_count;
		$configs['per_page'] = $limit;
		$no = ($pagenum-1)*$limit+1;

		$pagination = $this->CommonModel->page_all($configs);

		$data['title'] = 'Items | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['srch_txt'] = $srch_txt;
		$data["pagination"] = $pagination;
		$data['items_list'] = $this->ItemModel->get_rows($where, $offset, $limit);

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('items', $data);
		$this->load->view('template/footer', $data);
	}

	public function jobs()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]))
			redirect('Auth', 'refresh');

		$msg = '';			
		$saveBtn = $this->input->post('saveBtn', TRUE);
		if($saveBtn == "ok"){
			$item = $this->input->post('item', TRUE);

			$jobs = $this->input->post('jobs', TRUE);
			$cost = $this->input->post('cost', TRUE);

			$insert_data = array(
				'item_id' => $item,
				'job' => $jobs,				
				'created_at' => date('Y-m-d H:i:s')
			);

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){
				$this->ItemModel->update_jobs_row($insert_data, array('id' => $add_id));
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						The Job has been updated successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}else{
				$this->ItemModel->insert_jobs_row($insert_data);
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						New Job has been added successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}
		}

		$delBtn = $this->input->post('delBtn', TRUE);
		if($delBtn == "ok"){
			$edit_id = $this->input->post('edit_id', TRUE);

			$update_data = array(
				'isDeleted' => 1
			);
			$this->ItemModel->update_jobs_row($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The Job has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

		$where = " and jobs_tb.isDeleted = 0";
		$srch_txt = $this->input->post('srch_txt', TRUE);
		if($srch_txt != "")
			$where .= " and jobs_tb.job like '%".$srch_txt."%'";
		
		$list_count = $this->ItemModel->get_jobcount($where);
		$limit = 10;
		$pagenum = $this->uri->segment(3);
		$pagenum=($pagenum)?($pagenum):1;
		$offset =($pagenum-1)*$limit;
		$configs['uri_segment']=3;

		$configs['base_url'] = base_url().'Items/jobs';
		
		$configs['total_rows'] =$list_count;
		$configs['per_page'] = $limit;
		$no = ($pagenum-1)*$limit+1;

		$pagination = $this->CommonModel->page_all($configs);

		$data['title'] = 'Jobs | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['srch_txt'] = $srch_txt;
		$data["pagination"]=$pagination;
		$data['jobs_list'] = $this->ItemModel->get_jobrows($where, $offset, $limit);
		$data['select_items_list'] = $this->ItemModel->get_itemrows(" and isDeleted = 0");

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('jobs', $data);
		$this->load->view('template/footer', $data);		
	}

	public function get_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$item_info = $this->ItemModel->getInfo($edit_id);
		echo(json_encode($item_info));
	}
	
	public function get_jobs_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$jobs_info = $this->ItemModel->getJobsInfo($edit_id);
		echo(json_encode($jobs_info));
	}
}
