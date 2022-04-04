<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

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
		if(empty($user_data) || !isset($user_data["id"]) || $user_data["isRole"] < 1)
			redirect('Auth', 'refresh');

		$msg = '';			
		$saveBtn = $this->input->post('saveBtn', TRUE);
		if($saveBtn == "ok"){
			$check_order_no = $this->OrdersModel->get_max_row(" and isDeleted = 0");
			if($check_order_no != 0){
				if(date("Ymd")."001" > $check_order_no){
					$order_no = date("Ymd")."001";
				}else{
					$order_no = $check_order_no+1;
				}
			}else{
				$order_no = date("Ymd")."001";
			}
			$order_item = $this->input->post('order_item', TRUE);
			$order_amount = $this->input->post('order_amount', TRUE);
			$order_unit = $this->input->post('order_unit', TRUE);
			$due_date = $this->input->post('due_date', TRUE);
			$unit_price = $this->input->post('unit_price', TRUE);

			$workday = explode("/", $due_date);
			
			$insert_data = array(
				'order_no' 		=> $order_no,
				'order_item' 	=> $order_item,
				'order_amount' 	=> $order_amount,
				'order_unit' 	=> $order_unit,
				'due_day' 		=> $workday[1],
				'due_month' 	=> $workday[0],
				'due_year' 	  	=> $workday[2],
				'unit_price' 	=> $unit_price,
				'order_income'	=> $order_amount * $unit_price,
				'accessory_cost'=> 0,
				'created_at' 	=> date('Y-m-d H:i:s')
			);

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){
				$this->OrdersModel->update_row($insert_data, array('id' => $add_id));
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						The Order has been updated successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}else{
				$this->OrdersModel->insert_row($insert_data);
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						New Order has been added successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}
		}

		$completeBtn = $this->input->post('completeBtn', TRUE);
		if($completeBtn == "ok"){
			$edit_id = $this->input->post('edit_id', TRUE);

			$update_data = array(
				'status' => 1
			);
			$this->OrdersModel->update_row($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The Order has been completed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

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
					The Order has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

		$where = " and order_tb.isDeleted = 0 and order_tb.status = 0";
		$srch_txt = $this->input->post('srch_txt', TRUE);
		if($srch_txt != "")
			$where .= " and order_tb.order_unit like '%".$srch_txt."%'";
		
		$list_count = $this->OrdersModel->get_count($where);
		$limit = 10;
		$pagenum = $this->uri->segment(3);
		$pagenum=($pagenum)?($pagenum):1;
		$offset =($pagenum-1)*$limit;
		$configs['uri_segment']=3;

		$configs['base_url'] = base_url().'Orders/index';
		
		$configs['total_rows'] =$list_count;
		$configs['per_page'] = $limit;
		$no = ($pagenum-1)*$limit+1;

		$pagination = $this->CommonModel->page_all($configs);

		$data['title'] = 'Orders | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;
		$data['srch_txt'] = $srch_txt;
		$data["pagination"] = $pagination;
		$data['orders_list'] = $this->OrdersModel->get_rows($where, $offset, $limit);
		$data['item_list'] = $this->OrdersModel->get_item_rows(" and isDeleted = 0");

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('orders', $data);
		$this->load->view('template/footer', $data);
	}

	public function get_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$order_info = $this->OrdersModel->getInfo($edit_id);
		echo(json_encode($order_info));
	}

	public function detail()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]) || $user_data["isRole"] < 1)
			redirect('Auth', 'refresh');

		$order_id = $this->input->get('order_id', TRUE);
		$item_id = $this->input->get('item_id', TRUE);

		$msg = '';			
		$saveBtn = $this->input->post('saveBtn', TRUE);
		if($saveBtn == "ok"){
			$job = $this->input->post('job', TRUE);
			$cost = $this->input->post('cost', TRUE);
			$required_quantity = $this->input->post('required_quantity', TRUE);
			$completed_quantity = $this->input->post('completed_quantity', TRUE);	
			
			if($completed_quantity == "")
				$completed_quantity = 0;
			
			$insert_data = array(
				'order_id' 			=> $order_id,
				'job_id' 			=> $job,
				'cost' 				=> $cost,
				'required_quantity' => $required_quantity,
				'completed_quantity' => $completed_quantity,
				'created_at' 		=> date('Y-m-d H:i:s')
			);

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){
				$this->OrdersModel->update_detailrow($insert_data, array('id' => $add_id));
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						The Order Detail has been updated successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}else{
				$this->OrdersModel->insert_detailrow($insert_data);
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						New Order Detail has been added successfully!
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
			$this->OrdersModel->update_detailrow($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The Order Detail has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}

		$where = " and order_detail_tb.order_id = '".$order_id."'";

		$data['title'] = 'Orders | G.M.S';
		$data['userdata'] = $user_data;
		$data["order_no"] = $this->OrdersModel->get_order_no(" and id = '".$order_id."'");
		$data["order_id"] = $order_id;
		$data["item_id"] = $item_id;
		$data['msg'] = $msg;
		$data['orders_list'] = $this->OrdersModel->get_detailrows($where);
		$data['job_list'] = $this->OrdersModel->get_job_rows(" and isDeleted = 0 and item_id = '".$item_id."'");

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('orders-detail', $data);
		$this->load->view('template/footer', $data);
	}

	public function accessories()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]) || $user_data["isRole"] < 1)
			redirect('Auth', 'refresh');

		$order_id = $this->input->get('order_id', TRUE);

		$msg = '';			
		$saveBtn = $this->input->post('saveBtn', TRUE);
		if($saveBtn == "ok"){
			$accessory = $this->input->post('accessory', TRUE);
			$unit = $this->input->post('unit', TRUE);
			$unit_price = $this->input->post('unit_price', TRUE);
			$cost = (int)$unit * (float)$unit_price;
			
			$insert_data = array(
				'order_id' 	 => $order_id,
				'accessory'  => $accessory,
				'unit' 		 => $unit,
				'unit_price' => $unit_price,
				'cost' 		 => $cost,
				'created_at' => date('Y-m-d H:i:s')
			);

			$add_id = $this->input->post('add_id', TRUE);
			if($add_id != ""){
				$this->OrdersModel->update_accessoryrow($insert_data, array('id' => $add_id));
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						The Accessories has been updated successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';

				$accessoryCost = $this->OrdersModel->get_accessorycost(" and order_id = '".$order_id."'");
				$update_data = array(
					'accessory_cost' => $accessoryCost
				);
				$this->OrdersModel->update_row($update_data, array('id' => $order_id));

			}else{
				$this->OrdersModel->insert_accessoryrow($insert_data);
				$msg = '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="mdi mdi-check-all mr-2"></i>
						New Accessories has been added successfully!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';

				$accessoryCost = $this->OrdersModel->get_accessorycost(" and order_id = '".$order_id."'");
				$update_data = array(
					'accessory_cost' => $accessoryCost
				);
				$this->OrdersModel->update_row($update_data, array('id' => $order_id));
			}
		}

		$delBtn = $this->input->post('delBtn', TRUE);
		if($delBtn == "ok"){
			$edit_id = $this->input->post('edit_id', TRUE);

			$update_data = array(
				'isDeleted' => 1
			);
			$this->OrdersModel->update_accessoryrow($update_data, array('id' => $edit_id));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The Accessories has been removed successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';

			$accessoryCost = $this->OrdersModel->get_accessorycost(" and order_id = '".$order_id."'");
			$update_data = array(
				'accessory_cost' => $accessoryCost
			);
			$this->OrdersModel->update_row($update_data, array('id' => $order_id));
		}

		$where = " and order_id = '".$order_id."'";

		$data['title'] = 'Orders | G.M.S';
		$data['userdata'] = $user_data;
		$data["order_no"] = $this->OrdersModel->get_order_no(" and id = '".$order_id."'");
		$data["order_id"] = $order_id;
		$data['msg'] = $msg;
		$data['accessory_cost'] = $this->OrdersModel->get_accessorycost($where);
		$data['orders_list'] = $this->OrdersModel->get_accessoryrows($where);

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('orders-accessories', $data);
		$this->load->view('template/footer', $data);
	}
	
	public function get_detail_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$order_detail_info = $this->OrdersModel->getDetailInfo($edit_id);
		echo(json_encode($order_detail_info));
	}

	public function get_accessory_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$accessory_info = $this->OrdersModel->getAccessoryInfo($edit_id);
		echo(json_encode($accessory_info));
	}
}
