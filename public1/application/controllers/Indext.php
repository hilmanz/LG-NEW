<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indext extends CI_Controller {
	
	
	public function index()
	{
		//define('EXT', '.php');
		$this->load->view('index');
	}
}
