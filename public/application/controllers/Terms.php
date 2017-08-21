<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {
	
	 public function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
		$this->load->library('facebook'); // Automatically picks appId and secret from config
		$this->load->library(array('Pagination','image_lib'));			
	}
	
	public function index(){
		//echo "sss"; die;
		$this->load->view('page/header');
		$this->load->view('term/index');
		$this->load->view('page/footer');
	}
	
}
?>