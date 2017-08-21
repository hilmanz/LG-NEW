<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct()
	{
	parent::__construct();
	$this->is_logged_in();
	}
	
	public function index(){
		
		$this->load->library('table');		
		$contents=$this->db->query('select * from user')->result_array();
		
		$data = array(
			"contents" => $contents,		
		);
		$comp = array(
			'content' => $this->load->view("user/content",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('user/index',$comp);
	}
	
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
	
	function contentedit($id){
		$pdo = $this->connect();
		$lg = $this->mymodel->GetList("user","where id = '$id'");
			$sql = "select password from user where id='$id'";
			$q = $pdo->prepare($sql);
			$q->execute();
			$qq = $q->fetchAll();
			foreach ($qq as $qqq){
			$re = $qqq['password'];}
			//echo $re; die;
			//$encrypted = $this->encryptIt($re);
		$decrypted = $this->decryptIt($re);
		//echo $re . '<br />' . $decrypted;
		
		//echo $id; die;
		$data = array(
			"id" => $lg[0]['id'],			
			"nama" => $lg[0]['nama'],
			"username" => $lg[0]['username'],
			"password" => $decrypted,
			
		);
		$comp = array(
			'contentedit' => $this->load->view("user/edit",$data,true),
			'header' => $this->header(),
			'footer' => $this->footer(),			
		);
		
		$this->load->view('user/edit-content',$comp);
	}
		
	function abc(){
		$abc = 'admin';
		$encrypted = $this->encryptIt($abc);
		$decrypted = $this->decryptIt($encrypted);
		echo $encrypted . '<br />' . $decrypted;
	}
	
	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$encrypted = $this->encryptIt($password);
		//pr($nama);die;
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'nama' => $nama,
			'username' => $username,
			'password' => $encrypted,
		);
		//print_r($data_update);
		//pr($data_update);die;
		$res = $this->mymodel->UpdateDataUser('user',$data_update,$where);
		if($res>=1){
			redirect('user');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	function Active($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 1,			
		);
		
		$res = $this->mymodel->UpdateStatusUser('user',$data_update,$where);
		if($res>=1){
			redirect('user');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	function Inactive($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 0,			
		);
		
		$res = $this->mymodel->UpdateStatusUser('user',$data_update,$where);
		if($res>=1){
			redirect('user');			
		}else{
			echo "GAGAL!!!";
		}
	}
		
	function Delete($id){
		$data = array(
			"n_status" => '2',
		);
		$where = array(
			"id" => $id,
		);
		
		$lg = $this->mymodel->DeleteDataUser("user",$data,$where);
		
		if($lg>=1){
			redirect('user');			
		}else{
			echo "GAGAL!!!";
		}
	}
	

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}
	
	function header(){
		$data = array();
		return $this->load->view('global/header',$data,true);
	}
		
	function footer(){
		$data = array();
		return $this->load->view('global/footer',$data,true);
	}

	function connect() {
		$host = '202.80.113.116';
		$db_name = 'db_lg';
		$db_user = 'root';
		$db_password = 'coppermine';
		return new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}	
}
