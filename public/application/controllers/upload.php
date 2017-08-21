<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends CI_Controller {
  
  public function index() {
    $this->load->view('image');
  }
  
  public function upload_file(){
	  $status = "";
	  $msg = "";
	  $filename = 'image';
	  
	  if(empty($_POST['title'])){
		  $status = "error";
		  $msg = "Please Insert type";
	  }
	  
	  if($status != "error"){
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1024 * 8;
		$config['encrypt_name'] = true;
		
		$this->load->library('upload',$config);
		
		
		@unlink($_FILES[$filename]);
		
	  }
	  echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
}