<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	
	 public function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
		$this->load->library('facebook'); // Automatically picks appId and secret from config
		$this->load->library(array('Pagination','image_lib'));			
	}
	
	public function index(){	
		$this->load->view('page/header');
		$this->load->view('about/index');
		$this->load->view('page/footer');
	}
}
?>