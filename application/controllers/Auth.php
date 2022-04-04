<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
	}

	public function index()
	{
		$user_data = $this->session->userdata('gms2020');
		if(!empty($user_data) || isset($user_data["id"])){
			redirect('home', 'refresh');
		}else{
			$msg = '';
			$login_btn = $this->input->post('login_btn', TRUE);
			if($login_btn == "ok"){
				$username = $this->input->post('username', TRUE);
				$userpwd = $this->input->post('userpwd', TRUE);
				$tnc = $this->input->post('tnc', TRUE);

				$result = $this->AuthModel->get_row(" where username = '".$username."' and userpwd = '".md5($userpwd)."'");
				if(count($result) > 0){

					if($result['isDeleted'] == 0){
						if($tnc == 'on'){
							$this->input->set_cookie('username', $username, 3600000);
							$this->input->set_cookie('userpwd', $userpwd ,3600000);
							$this->session->set_userdata('gms2020', $result);
							redirect('home', 'refresh');
						}else{
							$this->session->set_userdata('gms2020', $result);
							redirect('home', 'refresh');
						}
						
					}else{
						$msg = '<div class="alert alert-danger"> You have already deleted your account.</div>';
					}
					
				}else{
					$msg = '<div class="alert alert-danger"> Sorry, but we can not match your account.</div>';
				}
			}

			$data['title'] = 'Login | G.M.S';
			$data['msg'] = $msg;

			$this->load->view('auth', $data);
		}		
	}

	public function logout()
	{
		$this->session->unset_userdata('gms2020');
		redirect('Auth', 'refresh');
	}
}
