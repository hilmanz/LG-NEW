<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contentmanagement extends CI_Controller {
	
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
        $config['base_url']    = base_url().'content_management/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['contents'] = $this->mymodel->getRows(array('limit'=>$this->perPage));
        //$data['total_rows'] = $this->mymodel->getRows(array('limit'=>$totalRec));
        
        $comp = array(
			'content' => $this->load->view("admin/contentmanagement_list",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('admin/contentmanagement',$comp);
        //load the view
       // $this->load->view('admin/usermanagement_list', $data);
    }
    /*
	{
		$this->load->library('pagination');
		$this->load->library('table');
		$jmluser = $this->mymodel->konten("content_management");
		
		$totalrows=$jmluser->num_rows();
		$config['base_url'] = base_url().'admin/contentmanagement';
		$config['total_rows'] = $totalrows;
		$config['per_page'] = 10;
		$config['first_link']='Awal';
		$config['last_link']='Akhir';
		$config['prev_link']='<<';
		$config['next_link']='>>';
		
			
		
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
	$start = $this->uri->segment(3, 0);
	//echo $start; die;
		$contents=$this->db->query('select *,content_management.n_status as stat, content_management.id as ids, content_management.nama as namas,content_management.type_campaign as camp, content_management.created as dated, jenis_produk.nama as produk from content_management, jenis_produk where content_management.jns_produk=jenis_produk.id  limit '.$start.','.$config['per_page'].'  ')->result_array();
		//echo $contents; die;
		
		$data = array(
		"contents" => $contents,
		"halaman" => $this->pagination->create_links()
			//"contents" => $this->mymodel->GetContent()
		);
		$comp = array(
			'content' => $this->load->view("admin/contentmanagement_list",$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('admin/contentmanagement',$comp);
	}*/
	
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
		$lg = $this->mymodel->GetContent("where id = '$id'");
		$data = array(
			"nama" => $lg[0]['nama'],
			"notelp" => $lg[0]['notelp'],
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
	
	function Inactive($id){
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 0,			
		);
		
		$res = $this->mymodel->StatusInactive('content_management',$data_update,$where);
		
		if($res>=1){
			redirect('Contentmanagement');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	function Actived($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		//echo $id; die;
		$email=$lg[0]['email'];
		
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 1,
			
		);
		
		$res = $this->mymodel->UpdateData('content_management',$data_update,$where);
		
		
		$link= strtr(base64_encode($email), '+/=', '-_,');
			//$link= urlencode(base64_encode($email));
			$link2 = "lg.kanadigital.com/public/page/galeri/";
			
			$template =' <div style=" background:#730000; color:#fff; padding:40px 30px; font-family:sans-serif; line-height: 24px;">
                        <p>Hai, </p>
                        <p>Cerita Anda sudah di approve oleh Admin<strong style="color:#fdcb02;"> LG Digital</strong>.<br></p>';
                        
                       
			
				
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
			redirect('Contentmanagement');			
		}else{
			echo "GAGAL!!!";
		}
	}
	
	/* function ubahstatus($id){
		$lg = $this->mymodel->GetContent("where id = '$id'");
		
		$email=$lg[0]['email'];
		
		$where = array(
			'id' => $id
		);
		$data_update = array(
			'n_status' => 1,
			
		);
		
		$res = $this->mymodel->UpdateData('content_management',$data_update,$where);
		
		
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
			redirect('Contentmanagement');			
		}else{
			echo "GAGAL!!!";
		}
	} */
	
	
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
			redirect('Contentmanagement');			
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
