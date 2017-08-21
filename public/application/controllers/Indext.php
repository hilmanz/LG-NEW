<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indext extends CI_Controller {
	public function index()
	{
		$data['rows']=$this->db->query('select * from content_management where n_status=1 and data_stat=1 AND type_campaign="cerita" order by id desc limit 4')->result();
		$data['gambar1']=$this->db->query('select * from content_management where n_status=1 and data_stat=1 AND type_campaign = "gambar" order by id desc limit 1')->result();
		$data['gambar2']=$this->db->query('select * from content_management where n_status=1 and data_stat=1 AND type_campaign = "gambar" order by id desc limit 1 offset 1')->result();
		$this->load->view('page/index',$data);
	}
}
