<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menupertama extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->spark('gravatar_helper/1.2');
	}
	
	public function index()
	{
		//echo '<img src="' . Gravatar_helper::from_email('zulisk93@gmail.com') . '">';
		$this->load->view('menu1');
	}
	
	/* public function submenu()
	{
		$data = array(
			"contents" => $this->mymodel->GetKonten()->result_array()
		);
		$this->load->view('submenu1',$data);
	} */
	
	public function submenu()
	{
		//load model
		$this->load->model('mymodel');
		
		//get data from the database
		$data['images'] = $this->mymodel->get_images();
		
		//load view and pass the data
		$this->load->view('submenu1', $data);
	}
	
	function login(){
		
		$fb_config = array(
			'appId' => '533895273426413',
			'secret' => 'd5801507ff7b26b5044960cf8c8a6e85',
		);
		
		$this->load->library('facebook', $fb_config);
		//$facebook = new facebook();
		$user = $this->facebook->getUser();
		
		if($user){
			try{
				$profile = $this->facebook->api('/me?fields=id,name,link,email');
			}
			catch(FacebookApiException $e){
				$user = null;
			}
			echo '<pre>';
print_r($profile);
		}
		
		if($user){
			$data['logout_url'] = $this->facebook->getLogoutUrl();
		}else{
			$data['login_url'] = $this->facebook->getLoginUrl();
		}
		$this->load->view('sosmed/index', $data);
	
	}
	
	function insert(){
		$nama = $_POST['nama'];
		$no_telp = $_POST['notelp'];
		$email = $_POST['email'];
		$jenis = $_POST['jns_produk'];
		$cerita = $_POST['cerita'];
		//$created = 'now()';
		$data = array(
			'nama' => $nama,
			'notelp' => $no_telp,
			'email' => $email,
			'jns_produk' => $jenis,
			'cerita' => $cerita,
			'type_campaign' => 'cerita',
			'n_status' => '0',
			'created' => date('Y-m-d', NOW())
		);
		//print_r($data);
		$res = $this->db->insert('content_management',$data);
		if($res>=1){
			echo '<script>alert("You Have Successfully Insert this Record!");</script>';
			redirect('','refresh');
		}else{
			echo "GAGAL!";
		}
	}
}
