<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('ProcessModel');
		$this->load->model('OrdersModel');
		$this->load->model('SalaryModel');
		$this->load->model('SetDateModel');
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
			$order_no = $this->input->post('order_no', TRUE);
			$customer = $this->input->post('customer', TRUE);
			$employee = $this->input->post('employee', TRUE);
			$job = $this->input->post('job', TRUE);	
			$dailydate = $this->input->post('dailydate', TRUE);
			$target = $this->input->post('target', TRUE);
			$completed_piece = $this->input->post('completed_piece', TRUE);	
			
			$costVal = $this->ProcessModel->get_cost_row(" and order_id = '".$order_no."' and job_id = '".$job."'");

			$salary = (float)$completed_piece * (float)$costVal;

			$workday = explode("/", $dailydate);
			
			$insert_data = array(
				'order_id' 	      => $order_no,
				'customer'     	  => $customer,
				'employee_id'     => $employee,
				'job_id' 	      => $job,
				'work_day' 		  => $workday[1],
				'work_month' 	  => $workday[0],
				'work_year' 	  => $workday[2],
				'target' 	      => $target,
				'completed_piece' => $completed_piece,
				'salary' 		  => $salary,
				'created_at'	  => date('Y-m-d H:i:s')
			);	
			
			$insert_salary_data = array(
				'order_id' 	      => $order_no,
				'employee_id'     => $employee,
				'job_id' 	      => $job,
				'calc_year' 	  => $workday[2],
				'calc_month' 	  => $workday[0],
				'completed_piece' => $completed_piece,
				'order_payment'   => $salary,
				'created_at'	  => date('Y-m-d H:i:s')
			);
			$order_detail_info = $this->OrdersModel->get_order_detail_rows(" where order_id = '".$order_no."' and job_id = '".$job."'");

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){		
				if($order_detail_info['required_quantity'] == ($order_detail_info['completed_quantity'] + $completed_piece)){
					$this->ProcessModel->update_row($insert_data, array('id' => $add_id));
					$this->SalaryModel->update_row($insert_salary_data, array('id' => $add_id));
					$msg = '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							The Process has been updated successfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					$completed_piece = $this->ProcessModel->get_completed_count(" and order_id = '".$order_no."' and job_id = '".$job."'");
					$updateData = array(
						'completed_quantity' => $completed_piece
					);
					$this->OrdersModel->update_detailrow($updateData, array('order_id' => $order_no, 'job_id' => $job));
					$msg = '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							The order has been completed!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				}else if($order_detail_info['required_quantity'] < ($order_detail_info['completed_quantity'] + $completed_piece)){
					$msg = '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							The completed quantity cannot exceed the required quantity.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				}else{
					$this->ProcessModel->update_row($insert_data, array('id' => $add_id));
					$this->SalaryModel->update_row($insert_salary_data, array('id' => $add_id));
					$msg = '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							The Process has been updated successfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					$completed_piece = $this->ProcessModel->get_completed_count(" and order_id = '".$order_no."' and job_id = '".$job."'");
					$updateData = array(
						'completed_quantity' => $completed_piece
					);
					$this->OrdersModel->update_detailrow($updateData, array('order_id' => $order_no, 'job_id' => $job));
				}
			}else{
				if($order_detail_info['required_quantity'] == ($order_detail_info['completed_quantity'] + $completed_piece)){
					$this->ProcessModel->insert_row($insert_data);
					$this->SalaryModel->insert_row($insert_salary_data);
					$msg = '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							New Process has been added successfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					$completed_piece = $this->ProcessModel->get_completed_count(" and order_id = '".$order_no."' and job_id = '".$job."'");
					$updateData = array(
						'completed_quantity' => $completed_piece
					);
					$this->OrdersModel->update_detailrow($updateData, array('order_id' => $order_no, 'job_id' => $job));
					$msg = '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							The order has been completed!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				}else if($order_detail_info['required_quantity'] < ($order_detail_info['completed_quantity'] + $completed_piece)){
					$msg = '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							The completed quantity cannot exceed the required quantity.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				}else{
					$this->ProcessModel->insert_row($insert_data);
					$this->SalaryModel->insert_row($insert_salary_data);
					$msg = '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="mdi mdi-check-all mr-2"></i>
							New Process has been added successfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					$completed_piece = $this->ProcessModel->get_completed_count(" and order_id = '".$order_no."' and job_id = '".$job."'");
					$updateData = array(
						'completed_quantity' => $completed_piece
					);
					$this->OrdersModel->update_detailrow($updateData, array('order_id' => $order_no, 'job_id' => $job));
				}
			}
		}

		$delBtn = $this->input->post('delBtn', TRUE);
		if($delBtn == "ok"){
			$edit_id = $this->input->post('edit_id', TRUE);
			$job_id = $this->input->post('job_id', TRUE);

			$update_data = array(
				'isDeleted' => 1
			);

			$this->ProcessModel->update_row($update_data, array('id' => $edit_id));
			$this->SalaryModel->update_row($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The Process has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';

			$res = $this->ProcessModel->getInfo($edit_id);
			$order_completed_info = $this->ProcessModel->get_order_completed_count(" where order_id = '".$res['order_id']."' and job_id = '".$job_id."'");

			$updateData = array(
				'completed_quantity' => $order_completed_info - $res['completed_piece']
			);
			$this->OrdersModel->update_detailrow($updateData, array('order_id' => $res['order_id'], 'job_id' => $job_id));
		}

		$where = " and daily_target_tb.isDeleted = 0";
		
		$srch_txt = $this->input->post('srch_txt', TRUE);
		if($srch_txt != ""){
			$order_res = $this->ProcessModel->get_orderNo_row($srch_txt);
			$employee_res = $this->ProcessModel->get_employee_row($srch_txt);
			if(count($order_res) > 0){
				$where .= " and daily_target_tb.order_id = '".$order_res['id']."'";
			}else if(count($employee_res) > 0){
				$where .= " and daily_target_tb.employee_id = '".$employee_res['id']."'";
			}else{
				$where .= " and daily_target_tb.customer like '%".$srch_txt."%'";
			}
		}
		
		$list_count = $this->ProcessModel->get_count($where);
		$limit = 10;
		$pagenum = $this->uri->segment(3);
		$pagenum=($pagenum)?($pagenum):1;
		$offset =($pagenum-1)*$limit;
		$configs['uri_segment']=3;

		$configs['base_url'] = base_url().'Process/index';
		
		$configs['total_rows'] =$list_count;
		$configs['per_page'] = $limit;
		$no = ($pagenum-1)*$limit+1;

		$pagination = $this->CommonModel->page_all($configs);

		$data['title'] = 'Process | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['srch_txt'] = $srch_txt;
		$data["pagination"] = $pagination;
		$data['orderNo_list'] = $this->ProcessModel->get_orderNo_rows(" and isDeleted = 0 and status = 0");
		$data['jobs_list'] = $this->ProcessModel->get_jobs_rows(" and isDeleted = 0");
		$data['employee_list'] = $this->ProcessModel->get_employee_rows(" and isDeleted = 0");
		$data['date_info'] = $this->SetDateModel->get_row();
		$data['process_list'] = $this->ProcessModel->get_rows($where, $offset, $limit);

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('process', $data);
		$this->load->view('template/footer', $data);
	}

	public function get_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$process_info = $this->ProcessModel->getInfo($edit_id);
		echo(json_encode($process_info));
	}

	public function get_order_info()
	{ 
		$order_id = $this->input->post("order_id");
		$order_info = $this->ProcessModel->getOrderInfo($order_id);
		echo(json_encode($order_info));
	}

	public function get_tcp_info()
	{
		$order_no = $this->input->post("order_no");
		$job_name = $this->input->post("job_name");
		//echo "Order_no:".$order_no." JOB:".$job_name;
		$tcp = $this->ProcessModel->getTcpInfo($order_no, $job_name);
		echo(json_encode($tcp));

	}
}