<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemodel extends CI_Model {

	function __construct(){
		parent :: __construct();
	}
	
	function insert_file($filename,$title){
		$data = array(
			'image' => $filename,
			'title' => $title,
		);
		
		$this->db->insert('file',$data);
		return $this->db->insert_id();
	}
	
	
	
}