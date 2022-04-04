<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetDate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('SetDateModel');
		
	}

	public function index()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]))
			redirect('Auth', 'refresh');
			
		$msg = '';
		$saveBtn = $this->input->post('saveBtn', TRUE);
		if($saveBtn == "ok"){
			$set_date = $this->input->post('set_date', TRUE);			
			
			$insert_data = array(
				'value' => $set_date
			);

			$this->SetDateModel->update_row($insert_data, array('id' => 1));
			$msg = '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="mdi mdi-check-all mr-2"></i>
					The date has been updated successfully!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}		

		$where = " and isDeleted = 0";

		$data['title'] = 'Date Setting | G.M.S';
		$data['userdata'] = $user_data;
		$data['msg'] = $msg;		
		$data['setdate_data'] = $this->SetDateModel->get_row();

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('setDate', $data);
		$this->load->view('template/footer', $data);		
	}

	public function get_info()
	{ 
		$edit_id = $this->input->post("edit_id");
		$date_info = $this->SetDateModel->getInfo($edit_id);
		echo(json_encode($date_info));
	}
}
