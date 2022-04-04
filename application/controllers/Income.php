<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('IncomeModel');
		$this->load->model('CommonModel');
	}

	public function index()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]) || $user_data["isRole"] < 1)
			redirect('Auth', 'refresh');
			
		$msg = '';
		$saveBtn = $this->input->post('saveBtn', TRUE);
		if($saveBtn == "ok"){
			$income_month = $this->input->post('income_month', TRUE);	
			$income_year = $this->input->post('income_year', TRUE);	

			$order_income = $this->IncomeModel->get_orderIncome(" and due_month = '".$income_month."' and due_year = '".$income_year."'");
			$employee_salary = $this->IncomeModel->get_employeeSalary("and work_month = '".$income_month."' and work_year = '".$income_year."'");
			$accessory_cost = $this->IncomeModel->get_accessoryCost(" and due_month = '".$income_month."' and due_year = '".$income_year."'");
			
			$insert_data = array(				
				'income_month' 		=> $income_month,
				'income_year'  		=> $income_year,
				'order_income' 		=> $order_income,
				'employee_salary' 	=> $employee_salary,
				'accessory_cost' 	=> $accessory_cost,
				'income_value' 		=> $order_income - $employee_salary - $accessory_cost,
				'created_at'   		=> date('Y-m-d H:i:s')
			);			

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){
				$this->IncomeModel->update_row($insert_data, array('id' => $add_id));
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						Monthly Income has been updated successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}else{
				$this->IncomeModel->insert_row($insert_data);
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						New Monthly Income has been added successfully!
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
			$this->IncomeModel->update_row($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					Monthly Income has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

		$where = " and isDeleted = 0";	

		$srch_year = $this->input->post("srch_year", TRUE);
		if($srch_year != "")
			$where .= " and income_year = '".$srch_year."'";
		
		$list_count = $this->IncomeModel->get_count($where);
		$limit = 10;
		$pagenum = $this->uri->segment(3);
		$pagenum=($pagenum)?($pagenum):1;
		$offset =($pagenum-1)*$limit;
		$configs['uri_segment']=3;

		$configs['base_url'] = base_url().'Income/index';
		
		$configs['total_rows'] =$list_count;
		$configs['per_page'] = $limit;
		$no = ($pagenum-1)*$limit+1;

		$pagination = $this->CommonModel->page_all($configs);

		$data['title'] = 'Income | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['srch_year'] = $srch_year;
		$data["pagination"] = $pagination;
		$data['income_list'] = $this->IncomeModel->get_rows($where, $offset, $limit);
		$data['graphic_list'] = $this->IncomeModel->get_graph_rows($where);

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('income', $data);
		$this->load->view('template/footer', $data);		
	}

	public function get_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$income_info = $this->IncomeModel->getInfo($edit_id);
		echo(json_encode($income_info));
	}
}
