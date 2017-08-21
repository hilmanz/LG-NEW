<?php
class Login extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->model('mymodel');
				$this->load->library(array('Pagination','image_lib'));
				$this->load->helper('form');
				$this->load->library('session');
				
        }
		
       public function index()
		{				
				
				$this->load->view('pages/login');
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
		redirect('usermanagement');
		
	}
	else{
		redirect('Login');
		
	}
	}
		
}