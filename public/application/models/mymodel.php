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
		//$query = $this->db->get('content_management');
		$query = $this->db->query("select * from content_management where type_campaign='gambar' order by id desc limit 1");
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
	
	function get_last_idcerita(){
		//$query = $this->db->get('content_management');
		$query = $this->db->query("select id from content_management order by id desc limit 1");
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
		
	public function insertfoto($tabel,$data){
		$hasil=$this->db->insert($tabel, $data); 
		//print_r($hasil);
		return $hasil;
	}
	
	public function insertdataakun($tabel,$data){
		$hasil=$this->db->insert($tabel, $data); 
		//print_r($hasil);
		return $hasil;
	}
	
	public function insertdatafb($tabel,$data){
		$hasil=$this->db->insert($tabel, $data); 
		//print_r($hasil);
		return $hasil;
	}	
	
	function get_images_gallery(){
		//$query = $this->db->get('content_management');
		$query = $this->db->query("select * from image order by id desc limit 8");
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
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
	
	public function UpdateData($tabelName,$data,$where){
		//echo $where."|";
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
		
	public function UpdateCeritaFacebook($tabelName,$data,$where){
		//echo $where."|";
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function UpdateCeritaTwitter($tabelName,$data,$where){
		//echo $where."|";
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}	
	
	function konten($tabel)
		{
			$query=$this->db->query("select * from $tabel order by id desc");
			 return $query;
		}
	function get_dropdown_list($tabel)
		{
			$result=$this->db->query("select * from $tabel order by id desc");
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
				$return[$row['id']] = $row['nama'];
		}
		}

        return $return;
		}
	function getCombos($table,$id) {
		$data = array();
		$options = array('state_id' => $id);
		$Q = $this->db->getwhere($table,$options,1);
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$Q->free_result();
		return $data;	
	}
		
	function getCombo($table) {
		$data = array();
		$Q = $this->db->get($table);
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$Q->free_result();
		return $data;	
	}
	function getCombo1($table) {
		$data = array();
		$Q = $this->db->get($table);
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$Q->free_result();
		return $data;	
	}
}
?>