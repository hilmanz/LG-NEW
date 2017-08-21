<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indext extends CI_Controller {

	public function index()
	{
		$comp = array(
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		
		if($this->session->userdata("logged_in")){
			$session_data=$this->session->userdata('logged_in');
			$data['username']=$session_data['username'];
			$this->load->view('pages/home',$comp);
		}else{
			$this->load->view('pages/login',$comp);
		}
		
	}
	
	function logout(){
		if($_GET["reset"]==1)
		{
			session_destroy();
			header('Location: ./../');
		}
	}
	
	
	function validatelogin(){
		//echo "ssss"; die;
	$this->load->model('mymodel');
	$query=$this->mymodel->validasi();
	//echo $query; die;
	if($query)
	{
		$session = array(
		'username'=>$this->input->post('username'),'is_logged_in'=>true);
		$this->session->set_userdata($session);
		redirect('Contentmanagement');
		
	}
	else{
		redirect('Login');
		
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
