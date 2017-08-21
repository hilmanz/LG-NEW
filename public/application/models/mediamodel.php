<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediamodel extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','url'));
	}
	
	//Generate Random Digit
	function genProfileThumb(){
		$tmpl = '_thumbnail_with_status';
		$recent_status = '';
		$recent_profilepic = base_url().'assets/images/profile.png';
		
		$data = array(
			'recent_status' => $recent_status,
			'recent_profilepic' => img($recent_profilepic)
		);
		return $this->load->view($tmpl, $data, true);
	}
	
}