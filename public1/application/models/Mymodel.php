<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model {
	
	public function GetKonten($where=""){
		$datas = $this->db->query("select * from content_management order by id desc limit 7".$where);
		return $datas;
	}
	
	function get_images(){
		//$query = $this->db->get('content_management');
		$query = $this->db->query("select * from content_management order by id desc limit 7");
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
	
	function get_last_images(){
		
		$results = array();
		
		
		$query = $this->db->query("select * from content_management where type_campaign='gambar' order by id desc limit 1");
		if($query->num_rows() > 0){
			$result = $query->result();
		}
			return $result;
	}
		
	public function upload_foto($tabel,$data){
		$hasil=$this->db->insert($tabel, $data); 
		//print_r($hasil);
		return $hasil;	
	}	
	
	function galeri($tabel)
		{
			$query=$this->db->query("select * from $tabel order by id desc");
			 return $query;
		}
}
?>