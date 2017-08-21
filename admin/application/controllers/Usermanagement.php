<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends CI_Controller {
	
	function __construct()
	{
	parent::__construct();
	$this->is_logged_in();
	$this->load->model('mymodel');
	$this->load->library('Ajax_pagination');
    $this->perPage = 10;
	}
	
	public function index()
	{
        $data = array();
        
        //total rows count
        $totalRec = count($this->mymodel->getRows());
        //echo $totalRec; die;
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'usermanagement/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['contents'] = $this->mymodel->getRows(array('limit'=>$this->perPage));
        //$data['total_rows'] = $this->mymodel->getRows(array('limit'=>$totalRec));
        
        $comp = array(
			'content' => $this->load->view("admin/usermanagement_list",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('admin/usermanagement',$comp);
        //load the view
       // $this->load->view('admin/usermanagement_list', $data);
    }

	/**{
		
		$this->load->library('pagination');
		$this->load->library('table');
		$jmluser = $this->mymodel->konten("content_management");
		
		$totalrows=$jmluser->num_rows();
		$config['base_url'] = base_url().'Usermanagement/index';
		$config['total_rows'] = $totalrows;
		$config['per_page'] = 10;
		$config['first_link']='Awal';
		$config['last_link']='Akhir';
		$config['prev_link']='<<';
		$config['next_link']='>>';
		
			
		
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
	$start = $this->uri->segment(3, 0);
	$contents=$this->db->query('select * from content_management where data_stat=1 order by id desc limit '.$start.','.$config['per_page'].'  ')->result_array();
	
		$data = array(
			"contents" => $contents,
			"halaman" => $this->pagination->create_links()
			//"contents" => $this->mymodel->GetUser()
		);
		$comp = array(
			'content' => $this->load->view("admin/usermanagement_list",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('admin/usermanagement',$comp);
	}**/
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		echo 'You don\'t have permission to access this page. <a href="../admin/login">Login</a>'; 
		redirect ('/login');
		//die();  
		//$this->load->view('login_form');
		}  
	} 
		
	
	function deleteuser($id){
		//echo $id;die;
		$where = array(
			'id' => $id
		);
		$data = array(			
			'n_status' => '2',
		);
		$res = $this->mymodel->deleteuser('content_management',$data,$where);
		if($res>=1){
			redirect('usermanagement');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$notelp = $_POST['notelp'];
		$email = $_POST['email'];
		//pr($nama);die;
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'nama' => $nama,
			'notelp' => $notelp,
			'email' => $email,
		);
		//print_r($data_update);
		//pr($data_update);die;
		$res = $this->mymodel->UpdateData('content_management',$data_update,$where);
		if($res>=1){
			redirect('usermanagement');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	public function paginationUser()
    {
        $data = array();
        
        //total rows count
        $totalRec = count($this->mymodel->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'usermanagement/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['contents'] = $this->mymodel->getRows(array('limit'=>$this->perPage));
        
        //load the view
        $this->load->view('admin/usermanagement_list', $data);
    }
    
    function ajaxPaginationData()
    {
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = count($this->mymodel->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'usermanagement/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        $data = array(
        	'contents' => $this->mymodel->getRows(array('start'=>$offset,'limit'=>$this->perPage)),
        	'pagesnum' => $offset,
        );
        //get the posts data
        //$data['contents'] = $this->mymodel->getRows(array('start'=>$offset,'limit'=>$this->perPage));
        $this->load->view('admin/paging-user', $data, false);
        //load the view
        
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
