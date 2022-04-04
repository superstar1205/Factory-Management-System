<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommonModel extends CI_Model{

	private $GF_DBM;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function page_all($configs) {
		$config['uri_segment'] = $configs['uri_segment'];
		$config['base_url'] = $configs['base_url'];

		$config['total_rows'] =$configs['total_rows'];
		$config['per_page'] = $configs['per_page'];

		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pagination-rounded justify-content-end mb-2">';
		$config['full_tag_close'] = '</ul>';

		$config['prev_link'] = '<i class="mdi mdi-chevron-left"></i>';
		$config['next_link'] = '<i class="mdi mdi-chevron-right"></i>';		

		$config['prev_tag_open'] = '<li class="page-item"><a href="javascript: void(0);" class="page-link">';
		$config['prev_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item"><a href="javascript: void(0);" class="page-link">';
		$config['num_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="page-item"><a href="javascript: void(0);" class="page-link">';
		$config['next_tag_close'] = '</a></li>';
		
		$config['cur_tag_open'] = '<li class="page-item active" style="position: relative; top: 26px; left: -20px;"><a href="javascript: void(0);" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';

		$config['display_pages'] = true; 

		$config['use_page_numbers']   = TRUE;
		//$config['page_query_string']  = TRUE;

		$config['anchor_class'] = "";
		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		return $pagination;
	}
}
?>