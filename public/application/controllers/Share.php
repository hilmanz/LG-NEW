<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Share extends CI_Controller{

	

	function index(){
		$this->load->helpers('share_helper');
		$this->load->view('twiiter/share');
		//echo ('ss');die;
	}
}

