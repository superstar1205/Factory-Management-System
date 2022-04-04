<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->model('IncomeModel');
	}

	public function index()
	{
		$user_data = $this->session->userdata('gms2020');
		if(empty($user_data) || !isset($user_data["id"]))
			redirect('Auth', 'refresh');
			
		$cur_month = date("m");
		$cur_year = date("Y");
		
		$where = " and isDeleted = 0";

		$data['title'] = 'Dashboard | G.M.S';
		$data['userdata'] = $user_data;
		$data['totalSalary'] = $this->HomeModel->get_totalSalary(" and isDeleted = 0 and work_month = '".$cur_month."' and work_year = '".$cur_year."'");
		$data['employeeCount'] = $this->HomeModel->get_employeecount(" and isDeleted = 0");
		$data['ordersCount'] = $this->HomeModel->get_ordercount(" and isDeleted = 0");
		$data['incomeMoney'] = $this->HomeModel->get_incomeMoney(" and isDeleted = 0");

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('index', $data);
		$this->load->view('template/footer', $data);
	}
}
