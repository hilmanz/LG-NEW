<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenisproduk extends CI_Controller {
	
	function __construct()
	{
	parent::__construct();
	$this->is_logged_in();
	$this->load->library(array('Pagination','image_lib'));
	}
	
	public function index()
	{
		$this->load->library('pagination');
		$this->load->library('table');
		$jmluser = $this->mymodel->konten("jenis_produk");
		
		$totalrows=$jmluser->num_rows();
		$config['base_url'] = base_url().'jenisproduk/index';
		$config['total_rows'] = $totalrows;
		$config['per_page'] = 10;
		$config['first_link']='Awal';
		$config['last_link']='Akhir';
		$config['prev_link']='<<';
		$config['next_link']='>>';
		
			
		
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
	$start = $this->uri->segment(3, 0);
		$contents=$this->db->query('select * from jenis_produk limit '.$start.','.$config['per_page'].'  ')->result_array();
		
		
		$data = array(
		"contents" => $contents,
		"halaman" => $this->pagination->create_links()
			//"contents" => $this->mymodel->GetContent()
		);
		$comp = array(
			'content' => $this->load->view("jenisproduk/content",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('jenisproduk/index',$comp);
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
	
	
	function addcontent(){
		$data=array();
		$comp = array(
			'contentedit' => $this->load->view("jenisproduk/add",$data,true),
			'header' => $this->header(),
			'footer' => $this->footer(),			
		);
		$this->load->view('jenisproduk/add-content',$comp);
	}
	
	function contentedit($id){
		$lg = $this->mymodel->GetList("jenis_produk","where id = '$id'");
		$data = array(
			"id"=> $lg[0]['id'],
			"nama" => $lg[0]['nama'],
			"keterangan" => $lg[0]['keterangan'],
			"banner" => $lg[0]['banner'],
			
		);
		$comp = array(
			'contentedit' => $this->load->view("jenisproduk/edit",$data,true),
			'header' => $this->header(),
			'footer' => $this->footer(),			
		);
		$this->load->view('jenisproduk/edit-content',$comp);
	}
	
	function ubahstatus($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		
		$email=$lg[0]['email'];
		
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 1,
			
		);
		
		$res = $this->mymodel->UpdateData('jenis_produk',$data_update,$where);
		
		
		$link= strtr(base64_encode($email), '+/=', '-_,');
			//$link= urlencode(base64_encode($email));
			$link2 = "lg.kanadigital.com/public/page/galeri/";
			
			$template =' <div style=" background:#730000; color:#fff; padding:40px 30px; font-family:sans-serif; line-height: 24px;">
                        <p>Hai, </p>
                        <p>Cerita Anda sudah di approve oleh Admin<strong style="color:#fdcb02;">LG Digital</strong>.<br><a style="color:#fdcb02; text-decoration:none;" target="blank
                        " href='.$link2.'>Klik disini</a> untuk bergabung.<br>
                        Jika anda tidak bisa klik link di atas, copy link di bawah ini ke browser<br><span style="color:#fdcb02;"></span></p>';
                        
                       
			
				
			$template .= $link2;
			$template .= '</div>';
			$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';
			
		
			///Send Email
			///Send Email
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
					  'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
							array('from' => 'LG Digital<sscr-admin@LGDigital.co.id>',
								  'to' => $email,
								  'subject' => 'Registrasi Member ',
								  'html' => $template,
								  'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			
			$res2 = json_decode($result,TRUE);
		
		if($res>=1){
			redirect('jenisproduk');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	
	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$keterangan = $_POST['keterangan'];
		//$banner='';
		$x=$_FILES['banner']['name'];
		
		//echo $x;exit;
	if(isset($_FILES['banner']['name'])){	
	
	$config['image_library'] = 'gd2';		
	$banner=$_FILES['banner']['name'];
	$acak=rand(00000000000,99999999999);
	$bersih=$_FILES['banner']['name'];
	$nm=str_replace(" ","_","$bersih");
	$pisah=explode(".",$nm);
	$nama_murni=$pisah[0];
	$banner=$acak.'.jpg'; 
	//$banner=$acak.$nama_murni; //tanpa ekstensi	
	$config['file_name']=$banner;;		
	$config['upload_path'] = '../public/produk';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']    = '30000';
	$config['max_width']  = '1024';
	$config['max_height']  = '768';
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	
// You can give video formats if you want to upload any video file.
	
	if ( ! $this->upload->do_upload('banner'))
	{
		
	//$error = array('error' = $this->upload->display_errors());
	echo $this->upload->display_errors();
	//echo base_url().$config['upload_path'];
	// uploading failed. $error will holds the errors.
	
	}
	else
	{
	$data = array('upload_data' => $this->upload->data());
	}
	}	
	
		if(!empty($_FILES['banner']['name'])){	
			$data_update = array(
			'nama' => $nama,
			'banner' => $banner,
			'keterangan' => $keterangan,		
			
		);			
		
		}else{
			$data_update = array(
			'nama' => $nama,
			'keterangan' => $keterangan,	
			);
		}
		
		
	
		//pr($nama);die;
		$where = array(
			'id' => $id
		);
		
		//print_r($data_update);
		//pr($data_update);die;
		$res = $this->mymodel->UpdateData('jenis_produk',$data_update,$where);
		if($res>=1){
			redirect('jenisproduk');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	
	function insert(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$keterangan = $_POST['keterangan'];
		$banner='';
		$x=$_FILES['banner']['name'];
		
		//echo $x;exit;
	if(isset($_FILES['banner']['name'])){	
	
	$config['image_library'] = 'gd2';		
	$banner=$_FILES['banner']['name'];
	$acak=rand(00000000000,99999999999);
	$bersih=$_FILES['banner']['name'];
	$nm=str_replace(" ","_","$bersih");
	$pisah=explode(".",$nm);
	$nama_murni=$pisah[0];
	$banner=$acak.'.jpg'; //tanpa ekstensi	
	$config['file_name']=$banner;;		
	$config['upload_path'] = '../public/produk';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']    = '30000';
	$config['max_width']  = '1024';
	$config['max_height']  = '768';
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
 
// You can give video formats if you want to upload any video file.
	
	if ( ! $this->upload->do_upload('banner'))
	{
		
	//$error = array('error' = $this->upload->display_errors());
	echo $this->upload->display_errors();
	//echo base_url().$config['upload_path'];
	// uploading failed. $error will holds the errors.
	
	}
	else
	{
	$data = array('upload_data' => $this->upload->data());
	}
		
	
		
			$data = array(
			'nama' => $nama,
			'banner' => $banner,
			'keterangan' => $keterangan,		
			
		);			
		
		}else{
			$data = array(
			'nama' => $nama,
			'keterangan' => $keterangan,	
			);
		}
		
		
	
		$res = $this->mymodel->InsertData('jenis_produk',$data);
		if($res>=1){
			redirect('jenisproduk');			
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
		
		$res = $this->mymodel->UpdateStatusJenisProduk('jenis_produk',$data_update,$where);
		if($res>=1){
			redirect('jenisproduk');			
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
		
		$res = $this->mymodel->UpdateStatusJenisProduk('jenis_produk',$data_update,$where);
		if($res>=1){
			redirect('jenisproduk');			
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
		
		$lg = $this->mymodel->DeleteDataJenisProduk("jenis_produk",$data,$where);
		
		if($lg>=1){
			redirect('jenisproduk');			
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
