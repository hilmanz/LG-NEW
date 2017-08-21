<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model {
	function __construct() {
        $this->postTable = 'content_management';
    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->postTable);
        $this->db->order_by('id','desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }


	public function GetContent($where=""){
		$datas = $this->db->query("select * from content_management ".$where);
		return $datas->result_array();
	}
	
	public function GetList($table,$where=""){
		$datas = $this->db->query("select * from $table ".$where);
		return $datas->result_array();
	}
	
	public function GetUser($where=""){
		$data = $this->db->query("select * from user_management ".$where);
		return $data->result_array();
	}
	
	
	public function InsertData($tabelName,$data){
		$res = $this->db->insert($tabelName,$data);
		return $res;
	}
	
	public function UpdateData($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function UpdateDataBanner($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function UpdateDataIklan($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function StatusInactive($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}		
	
	public function DeleteDataIklan($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function DeleteDataJenisProduk($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function UpdateStatusIklan($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function UpdateStatusJenisProduk($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function UpdateStatusUser($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function UpdateDataUser($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	public function deleteuser($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		//echo $res; die;
		return $res;
	}
	
	function konten($tabel)
		{
			$query=$this->db->query("select * from $tabel order by id desc");
			 return $query;
		}
	function validasi()
		{
			$this->db->where('username',
			$this->input->post('username'));
			$this->db->where('password',
			$this->encryptIt($this->input->post('password')));
			$ambil = $this->db->get('user');
			
			//echo $this->input->post('username')."|".$this->input->post('password');
			//exit;
			
			if($ambil->num_rows() == 1)
			{
				return true;
				//exit;
			}
		}
		
		function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
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
}