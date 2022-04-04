<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('EmployeeModel');
		$this->load->model('SalaryModel');
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
			$name = $this->input->post('name', TRUE);
			$birth_year = $this->input->post('birth_year', TRUE);
			$birth_month = $this->input->post('birth_month', TRUE);
			$birth_day = $this->input->post('birth_day', TRUE);
			$email = $this->input->post('email', TRUE);
			$address = $this->input->post('address', TRUE);
			$phone = $this->input->post('phone', TRUE);
			$status = $this->input->post('status', TRUE);
			
			$insert_data = array(
				'name' 				=> $name,
				'birth_year' 		=> $birth_year,
				'birth_month' 		=> $birth_month,
				'birth_day' 		=> $birth_day,
				'address' 			=> $address,
				'email' 			=> $email,
				'phone' 			=> $phone,
				'status' 			=> $status,
				'created_at' 		=> date('Y-m-d H:i:s')
			);			

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){
				$this->EmployeeModel->update_row($insert_data, array('id' => $add_id));
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						The Employee has been updated successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}else{
				$this->EmployeeModel->insert_row($insert_data);
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						New Employee has been added successfully!
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
			$this->EmployeeModel->update_row($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The Employee has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

		$where = " and isDeleted = 0";	

		$srch_txt = $this->input->post('srch_txt', TRUE);
		if($srch_txt != "")
			$where .= " and name like '%".$srch_txt."%'";
		
		$list_count = $this->EmployeeModel->get_count($where);
		$limit = 10;
		$pagenum = $this->uri->segment(3);
		$pagenum=($pagenum)?($pagenum):1;
		$offset =($pagenum-1)*$limit;
		$configs['uri_segment']=3;

		$configs['base_url'] = base_url().'Employee/index';
		
		$configs['total_rows'] =$list_count;
		$configs['per_page'] = $limit;
		$no = ($pagenum-1)*$limit+1;

		$pagination = $this->CommonModel->page_all($configs);

		$data['title'] = 'Employee | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['srch_txt'] = $srch_txt;
		$data["pagination"] = $pagination;
		$data['employee_list'] = $this->EmployeeModel->get_rows($where, $offset, $limit);

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('employee', $data);
		$this->load->view('template/footer', $data);		
	}

	public function get_info()
    { 
		$edit_id = $this->input->post("edit_id");
		$employee_info = $this->EmployeeModel->getInfo($edit_id);
		echo(json_encode($employee_info));
	}

	public function get_retbl()
	{
		$id = $this->input->post("id");
		$year = $this->input->post("syear");
		$month = $this->input->post("smonth");
		var_dump("eid:",$id,"Year:", $year, "month:", $month);
		// $result = $this->SalaryModel->getRetbl($id, $year, $month);
	}

	public function salary()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]))
			redirect('Auth', 'refresh');

		////////////////////////////////////////////////
		
		$id = $this->uri->segment(2);
		
		$msg = '';

		$edit_id = $this->input->post('edit_id', TRUE);
		$state = $this->input->post('state'.$edit_id, TRUE);

		if($edit_id != ""){
			$update_data = array(
				'status' => $state
			);

			$this->SalaryModel->update_row($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The Salary has been updated successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		$cpop_list = [];
		$where = " and salary_tb.isDeleted = 0 and salary_tb.employee_id = '".$id."'";
		$srch_year = $this->input->post('srch_year', TRUE);
		if ($srch_year != "") {
			$where.=" and salary_tb.calc_year = '".$srch_year."'";
		}
		$srch_month = $this->input->post('srch_month', TRUE);
		if ($srch_month != "") {
			$where.=" and salary_tb.calc_month = '".$srch_month."'";
		}
		if ($srch_year !='' && $srch_month !=''){
			var_dump("ID:", $id, "Y:", $srch_year, "M:", $srch_month );
			$cpop_list = $this->SalaryModel->get_re_rows($id, $srch_year, $srch_month);
		}
		$employee_data = $this->EmployeeModel->getInfo($id);
		
		$data['title'] = 'Salary | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['id'] = $id;
		$data['srch_year'] = $srch_year;
		$data['srch_month'] = $srch_month;
		$data['cpop_list'] = $cpop_list;
		$data['employee_name'] = $employee_data['name'];
		$data['salary_list'] = $this->SalaryModel->get_rows($where." group by salary_tb.id");
		$data['paid_amount'] = $this->SalaryModel->get_paid_amount($where);
		$data['unpaid_amount'] = $this->SalaryModel->get_unpaid_amount($where);
		$data['total_amount'] = $this->SalaryModel->get_total_amount($where);
		

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('salary', $data);
		$this->load->view('template/footer', $data);		
	}
}