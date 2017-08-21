<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index()
	{
		$this->load->view('page/header');
		$this->load->view('page/home');
		$this->load->view('page/footer');
	}
	
	public function landing1(){	
		$this->load->view('page/header');
		$this->load->view('page/landing1');
		$this->load->view('page/footer');
	}
	
	public function login(){
		echo "satu";
		exit;
		$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		$user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            // Solves first time login issue. (Issue: #10)
            //$this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('page/uploadcerita'), 
                'scope' => array("email") // permissions here
            ));
        }
		$data = array(
						 'nama' => $data['user_profile']['name'],
						 'idfb' => $data['user_profile']['id'],
						 'img' =>"https://graph.facebook.com/".$user_profile['id']."/picture?type=large"
						 
						 
					);
				$res = $this->mymodel->insertdatafb('data_fb',$data);
							
					//print_r($res);
				//echo $res;
				if($res==1){
					echo '<script>alert("You Have Successfully Insert this Record!");</script>';
					redirect('Page/uploadcerita');
					//echo $config['upload_path'];
				}else{
					echo "GAGAL!";
				} 
        redirect('Page/uploadcerita');
	

	}

    public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('page/login');
    }
	
	public function sosmed(){
		$session = array(
		'username'=>'aaa','is_logged_in'=>true);
		$this->session->set_userdata($session);		
		$this->load->view('login/config');
		$this->load->view('login/inc/twitteroauth');
		$this->load->view('login/index1');		
	}
	
	public function prosestwitter(){			
		$this->load->view('login/config');
		$this->load->view('login/inc/twitteroauth');
		$this->load->view('login/processtwitter');		
	}
	
	public function landing2(){	
		$this->load->view('page/header');
		$this->load->view('page/landing2');
		$this->load->view('page/footer');
	}
	
	public function gallery(){		
		$this->load->view('page/header');
		$this->load->view('page/gallery');
		$this->load->view('page/footer');
	}
	
	public function term(){	
		$this->load->view('page/header');
		$this->load->view('page/term');
		$this->load->view('page/footer');
	}
	
	public function prize(){	
		$this->load->view('page/header');
		$this->load->view('page/prize');
		$this->load->view('page/footer');
	}
	
	public function uploadcerita(){	
	$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		$user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            // Solves first time login issue. (Issue: #10)
            //$this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('welcome/login'), 
                'scope' => array("email") // permissions here
            ));
        }
		$this->load->view('page/header');
		$this->load->view('page/uploadcerita',$data);
		$this->load->view('page/footer');
	}
	
	public function uploadphoto(){	
		$this->load->view('page/header');
		$this->load->view('page/uploadphoto');
		$this->load->view('page/footer');
	}
	
	
	
	public function submenu(){		
		
		$this->load->model('mymodel');
		
		
		//get data from the database
		$data['images'] = $this->mymodel->get_images();
		$data['results'] = $this->mymodel->get_last_images();
		
		//load view and pass the data
		$this->load->view('submenu2', $data);
		$this->load->view('slide', $data);
	}
	
	function status($email){
		//$link= strtr(base64_encode('fauzi.rahman@ksns.co.id'), '+/=', '-_,');
		//echo $link."<br>|";
		$email= base64_decode(strtr($email, '+/=', '-_,'))."<br>";
		//echo $email;
	
		
		$where = array(
			'email' => $email
		);
		$data_update = array(
			'n_status' => 1,			
		);
		
		$res = $this->mymodel->UpdateData('content_management',$data_update,$where);
		//echo $res;
		if($res>=1){
			redirect('../index');			
		}else{
			echo "GAGAL!!!";
		} 
	}
	
	
	public function insertphoto(){
		//echo var_dump($_POST);
			
		
			/* $acak=rand(00000000000,99999999999);
			$bersih=$_FILES['imagecrop']['name'];
			$nm=str_replace(" ","_","$bersih");
			$pisah=explode(".",$nm);
			$nama_murni=$pisah[0];
			$ubah=$acak.$nama_murni; //tanpa ekstensi
			$config['image_library'] = 'gd2';
			
			$gambar=$_FILES['imagecrop']['name'];;	
			$config['file_name']=$_FILES['imagecrop']['name'];;		
			$config['upload_path'] = "upload/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']    = '30000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768'; */
			
			
			/* $this->load->library('upload', $config);
			$this->upload->initialize($config); */
			
			$nama = $_POST['nama'];
			$telp = $_POST['tlpn'];
			$email = $_POST['email'];
			$imagecrop = $_POST['imagecrop'];
			$link= strtr(base64_encode($email), '+/=', '-_,');
			//$link= urlencode(base64_encode($email));
			$link2 = base_url()."page/status/".$link;
			
			$template =' <div style=" background:#730000; color:#fff; padding:40px 30px; font-family:sans-serif; line-height: 24px;">
                        <p>Hai, </p>
                        <p>Anda diundang untuk bergabung dengan <strong style="color:#fdcb02;">LG Digital</strong>.<br><a style="color:#fdcb02; text-decoration:none;" target="blank
                        " href='.$link2.'>Klik disini</a> untuk bergabung.<br>
                        Jika anda tidak bisa klik link di atas, copy link di bawah ini ke browser<br><span style="color:#fdcb02;">!#link</span></p>';
                        
                        
			
				
			$template .= base_url()."page/status/".$link;
			$template .= '</div>';
			
			
			$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';
		
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
			
			$res = json_decode($result,TRUE);				
	 
			/* if(!$this->upload->do_upload('imagecrop')){			
				echo $this->upload->display_errors();
				echo 'gagal'. $config['upload_path'];		
			}
			else{
				$data = array('upload_data' => $this->upload->data());	
				$url = 'upload/'; 
				$this->load->library('image_lib',$config);
				$files = $this->upload->data();
				$fileNameResize = $config['upload_path'].$files['file_name'];
				$size =  array(                
                        array('name'    => 'thumb','width'    => 100, 'height'    => 100, 'quality'    => '100%')
                    );
				$resize = array();
            foreach($size as $r){                
                $resize = array(
                    "width"            => $r['width'],
                    "height"        => $r['height'],
                    "quality"        => $r['quality'],
                    "source_image"    => $fileNameResize,
                    "new_image"        => $url.$r['name'].'/'.$files['file_name']
                );
            $this->image_lib->initialize($resize); 	
				   
			
			$this->image_lib->resize();
			if(!$this->image_lib->resize())                    
			die($this->image_lib->display_errors());
			}
			

				 */			
				$data = array(
						 'nama' => $nama,
						 'notelp' => $telp,
						 'email' => $email,
						 'type_campaign' => 'gambar',
						 'image' => $imagecrop,
						 'n_status' => 0,
						 'created'=> date('Y-m-d', NOW())
					);
				$res = $this->mymodel->upload_foto('content_management',$data);
							
					//print_r($res);
				//echo $res;
				if($res==1){
					echo '<script>alert("You Have Successfully Insert this Record!");</script>';
					redirect('Page/uploadphoto','refresh');
					//echo $config['upload_path'];
				}else{
					echo "GAGAL!";
				}
			//}
		
	}
	
	
	function insertcerita(){
		
		//echo var_dump($_POST);exit;
		$nama = $_POST['nama'];
		$notelp = $_POST['tlpn'];
		$email = $_POST['email'];
		$jenis = $_POST['produk'];
		$cerita = $_POST['kesan'];
		//$created = 'now()';
		$data = array(
			'nama' => $nama,
			'notelp' => $notelp,
			'email' => $email,
			'jns_produk' => $jenis,
			'cerita' => $cerita,
			'type_campaign' => 'cerita',
			'n_status' => '0',
			'created' => date('Y-m-d', NOW())
		);
		//print_r($data);
		$res = $this->db->insert('content_management',$data);
		$link= strtr(base64_encode($email), '+/=', '-_,');
			//$link= urlencode(base64_encode($email));
			$link2 = base_url()."page/status/".$link;
			
			$template =' <div style=" background:#730000; color:#fff; padding:40px 30px; font-family:sans-serif; line-height: 24px;">
                        <p>Hai, </p>
                        <p>Anda diundang untuk bergabung dengan <strong style="color:#fdcb02;">LG Digital</strong>.<br><a style="color:#fdcb02; text-decoration:none;" target="blank
                        " href='.$link2.'>Klik disini</a> untuk bergabung.<br>
                        Jika anda tidak bisa klik link di atas, copy link di bawah ini ke browser<br><span style="color:#fdcb02;">!#link</span></p>';
                        
                       
			
				
			$template .= base_url()."page/status/".$link;
			$template .= '</div>';
			$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';
			
		
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
			echo '<script>alert("You Have Successfully Insert this Record!");</script>';
			redirect('Page/uploadcerita','refresh');
		}else{
			echo "GAGAL!";
		}
	}
	
	
	public function galeri()
	{
	$this->load->library('pagination');
	$this->load->library('table');
	
	$data=array();
	$data["title"]='Galeri';
	$jmluser = $this->mymodel->galeri("content_management");
	$totalrows=$jmluser->num_rows();
	$id=$this->uri->segment(3);	
	$id=$id/2;
	$id=round($id);
	$id2=$id+1;
	$id3=$id2+4;
	$config['base_url'] = base_url().'menu2/galeri';
	$config['total_rows'] = $totalrows;
	$config['per_page'] = 16;
	$config['first_link']='Awal';
	$config['last_link']='Akhir';
	$config['prev_link']='<<';
	$config['next_link']='>>';
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
	$data['halaman']=$this->pagination->create_links();
	
	
	$start = $this->uri->segment(3, 0);

	
	$data['rows']=$this->db->query('select * from content_management limit '.$start.','.$config['per_page'].'  ')->result();
	$data['rows2'] = $this->db->query('select * from iklan limit '.$id2.',4 ')->result();
	$data['rows3'] = $this->db->query('select * from iklan LIMIT '.$id3.',4')->result();
	
	$this->load->view('galeri', $data);
	}
	
	function img_save_to_file(){
		$this->load->view('page/img_save_to_file');
	}

		
}
?>