<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iklan extends CI_Controller {
	
	function __construct()
	{
	parent::__construct();
	$this->is_logged_in();
	}
	
	public function index()
	{
		$this->load->library('pagination');
		$this->load->library('table');
		$jmluser = $this->mymodel->konten("iklan");
		
		$totalrows=$jmluser->num_rows();
		$config['base_url'] = base_url().'iklan/index';
		$config['total_rows'] = $totalrows;
		$config['per_page'] = 10;
		$config['first_link']='Awal';
		$config['last_link']='Akhir';
		$config['prev_link']='<<';
		$config['next_link']='>>';
		
			
		
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
	$start = $this->uri->segment(3, 0);
		$contents=$this->db->query('select *,iklan.n_status as stat, iklan.id as ids, jenis_produk.nama as produk from iklan, jenis_produk where iklan.jns_produk=jenis_produk.id limit '.$start.','.$config['per_page'].'  ')->result_array();
		
		
		$data = array(
		"contents" => $contents,
		"halaman" => $this->pagination->create_links()
			//"contents" => $this->mymodel->GetContent()
		);
		$comp = array(
			'content' => $this->load->view("iklan/content",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('iklan/index',$comp);
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
		$data=array(
		"combo" => $this->mymodel->getCombo("jenis_produk"),
		);
		$comp = array(
			'contentedit' => $this->load->view("iklan/add",$data,true),
			'header' => $this->header(),
			'footer' => $this->footer(),			
		);
		$this->load->view('iklan/add-content',$comp);
	}
	function contentedit($id){
		$lg = $this->mymodel->GetList("iklan","where id = '$id'");
		$data = array(
			"id"=> $lg[0]['id'],			
			"nama" => $lg[0]['nama'],
			"iklan" => $lg[0]['iklan'],
			"harga" => $lg[0]['harga'],
			"hrg_diskon" => $lg[0]['hrg_diskon'],
			
		);
		$comp = array(
			'contentedit' => $this->load->view("iklan/edit",$data,true),
			'header' => $this->header(),
			'footer' => $this->footer(),			
		);
		$this->load->view('jenisproduk/edit-content',$comp);
	}
	
	function ubahstatus($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		
		$jns_produk=$lg[0]['jns_produk'];
		
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 1,
			
		);
		
		$res = $this->mymodel->UpdateData('iklan',$data_update,$where);
		
		
		$link= strtr(base64_encode($jns_produk), '+/=', '-_,');
			//$link= urlencode(base64_encode($jns_produk));
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
								  'to' => $jns_produk,
								  'subject' => 'Registrasi Member ',
								  'html' => $template,
								  'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			
			$res2 = json_decode($result,TRUE);
		
		if($res>=1){
			redirect('iklan');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	
	function update(){
		$id = $_POST['id'];		
		$nama = $_POST['nama'];
		$harga = $_POST['harga'];
		$hrg_diskon = $_POST['hrg_diskon'];
		
		$x=$_FILES['iklan']['name'];
		
		//echo $x;exit;
	if(isset($_FILES['iklan']['name'])){	
	
	$config['image_library'] = 'gd2';		
	$iklan=$_FILES['iklan']['name'];
	$acak=rand(00000000000,99999999999);
	$bersih=$_FILES['iklan']['name'];
	$nm=str_replace(" ","_","$bersih");
	$pisah=explode(".",$nm);
	$nama_murni=$pisah[0];
	$iklan=$acak.'.jpg'; 
	//$banner=$acak.$nama_murni; //tanpa ekstensi	
	$config['file_name']=$iklan;;		
	$config['upload_path'] = '../public/iklan';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']    = '30000';
	$config['max_width']  = '1024';
	$config['max_height']  = '768';
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	
// You can give video formats if you want to upload any video file.
	
	if ( ! $this->upload->do_upload('iklan'))
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
	
		if(!empty($_FILES['iklan']['name'])){	
			$data_update = array(			
			'iklan' => $iklan,
			'nama' => $nama,		
			'harga' => $harga,		
			'hrg_diskon' => $hrg_diskon,		
			
		);			
		
		}else{
			$data_update = array(			
			'nama' => $nama,	
			'harga' => $harga,	
			'hrg_diskon' => $hrg_diskon,	
			);
		}
				
		//pr($nama);die;
		$where = array(
			'id' => $id
		);
		
		//print_r($data_update);
		//pr($data_update);die;
		$res = $this->mymodel->UpdateDataIklan('iklan',$data_update,$where);
		if($res>=1){
			redirect('iklan');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	function insert(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];		
		$harga = $_POST['harga'];
		$hrg_diskon = $_POST['hrg_diskon'];
		$jns_produk = $_POST['jns_produk'];
		
	if(isset($_FILES['iklan']['name'])){	
	
	$config['image_library'] = 'gd2';		
	$iklan=$_FILES['iklan']['name'];
	$acak=rand(00000000000,99999999999);
	$bersih=$_FILES['iklan']['name'];
	$nm=str_replace(" ","_","$bersih");
	$pisah=explode(".",$nm);
	$nama_murni=$pisah[0];
	$iklan=$acak.".jpg"; //tanpa ekstensi	
	//$iklan=$_FILES['iklan']['name'];
	$config['file_name']=$iklan;;		
	$config['upload_path'] = '../public/iklan';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']    = '30000';
	$config['max_width']  = '1024';
	$config['max_height']  = '768';
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	}
	
	if ( ! $this->upload->do_upload('iklan'))
	{
		
	//$error = array('error' = $this->upload->display_errors());
	echo $this->upload->display_errors();
	echo base_url().$config['upload_path'];
	// uploading failed. $error will holds the errors.
	
	}
	else
	{
	$data = array('upload_data' => $this->upload->data());
	}
	
	if(isset($_FILES['logo_toko']['name'])){	
	
	$config['image_library'] = 'gd2';		
	$logo_toko=$_FILES['logo_toko']['name'];
	$acak=rand(00000000000,99999999999);
	$bersih=$_FILES['logo_toko']['name'];
	$nm=str_replace(" ","_","$bersih");
	$pisah=explode(".",$nm);
	$nama_murni=$pisah[0];
	$logo_toko=$acak.".jpg"; //tanpa ekstensi	
	//$logo_toko=$_FILES['logo_toko']['name'];
	$config['file_name']=$logo_toko;;		
	$config['upload_path'] = '../public/iklan';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']    = '30000';
	$config['max_width']  = '1024';
	$config['max_height']  = '768';
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	}
// You can give video formats if you want to upload any video file.
	
	if ( ! $this->upload->do_upload('logo_toko'))
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
		
	
	if((isset($_FILES['logo_toko']['name']))or(isset($_FILES['logo_toko']['name']))){
			$data = array(
			'nama' => $nama,
			'iklan' => $iklan,
			'harga' => $harga,
			'hrg_diskon' => $hrg_diskon,
			'jns_produk' => $jns_produk,
			'logo_toko ' =>$logo_toko 
		);
		
		}else{
			$data = array(
			'nama' => $nama,
			'iklan' => $iklan,
			'harga' => $harga,
			'hrg_diskon' => $hrg_diskon,
			'jns_produk' => $jns_produk,
			
		);
		}
		
		
		
		//print_r($data_update);
		//pr($data_update);die;
		$res = $this->mymodel->InsertData('iklan',$data);
		if($res>=1){
			redirect('iklan');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	function Actived($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 1,			
		);
		
		$res = $this->mymodel->UpdateStatusIklan('iklan',$data_update,$where);
		if($res>=1){
			redirect('iklan');			
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
		
		$res = $this->mymodel->UpdateStatusIklan('iklan',$data_update,$where);
		if($res>=1){
			redirect('iklan');			
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
		
		$lg = $this->mymodel->DeleteDataIklan("iklan",$data,$where);
		
		if($lg>=1){
			redirect('iklan');			
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
