<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contentmanagement extends CI_Controller {
	public function index()
	{
		$data = array(
			"contents" => $this->mymodel->GetContent()
		);
		$comp = array(
			'content' => $this->load->view("contentmanagement/content",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('contentmanagement/index',$comp);
	}
	
	function contentedit($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		$data = array(
			"nama" => $lg[0]['nama'],
			"no_telp" => $lg[0]['no_telp'],
			"email" => $lg[0]['email'],
			"id" => $lg[0]['id'],
		);
		$comp = array(
			'contentedit' => $this->load->view("contentmanagement/edit",$data,true),
			'header' => $this->header(),
			'footer' => $this->footer(),			
		);
		$this->load->view('contentmanagement/edit-content',$comp);
	}
	
	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$no_telp = $_POST['no_telp'];
		$email = $_POST['email'];
		//pr($nama);die;
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'nama' => $nama,
			'no_telp' => $no_telp,
			'email' => $email,
		);
		//print_r($data_update);
		//pr($data_update);die;
		$res = $this->mymodel->UpdateData('content_management',$data_update,$where);
		if($res>=1){
			redirect('contentmanagement');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	function header(){
		$data = array();
		return $this->load->view('global/header',$data,true);
	}
		
	function footer(){
		$data = array();
		return $this->load->view('global/footer',$data,true);
	}	
}
