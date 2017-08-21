<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagetes extends CI_Controller {
	public function index()
	{
		$this->load->view('page/uploadcerita');
	}
}
