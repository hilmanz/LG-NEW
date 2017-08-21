<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
	 public function __construct()
        {
        	parent::__construct();
			// Loading TwitterOauth library. Delete this line if you choose autoload method.
			$this->load->library('twitteroauth');
			// Loading twitter configuration.
			$this->config->load('twitter');
			
			if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
			{
				// If user already logged in
				$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
			}
			elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
			{
				// If user in process of authentication
				$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
			}
			else
			{
				// Unknown user
				$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
			}
                $this->load->model('mymodel');
				$this->load->library('facebook'); // Automatically picks appId and secret from config
				$this->load->library(array('Pagination','image_lib'));
				
        }

    
	public function index()
	{
		$this->load->view('page/header');
		$this->load->view('page/home');
		$this->load->view('page/footer');
	}
	
	public function myfb(){	
		$this->load->library('facebook'); // Automatically picks appId and secret from config
		$this->load->view('page/header');
		$this->load->view('page/fb');
		//$this->load->view('page/footer');
	}
	
	public function kirimfb(){	
	$this->load->model('mymodel');
				$data = array(
						 'id_akun' => $_POST['id'],
						'nama_akun' => $_POST['name'],
						//'link' => $user_profile['link'],
						////'emailfb' => $user_profile['email'],
						'type_sosmed' => "facebook",
						'gambar_akun' => 'https://graph.facebook.com/'. $_POST['id'] .'/picture',
						//'created'=> date('Y-m-d', NOW()),
						//'n_status' => '1',
					);
					$res = $this->mymodel->insertdataakun('content_management',$data);
		
	}
	
	public function landing1(){	
		$this->load->view('page/header');
		$this->load->view('page/landing1');
		$this->load->view('page/footer');
	}
	
	public function loginfb(){
$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));
		$this->facebook->destroySession();

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
			
			$this->load->view('page/profile', $data);

            $data['logout_url'] =$this->facebook->getLogoutUrl(array('next' => base_url() . 'index.php/page/logout')); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl();

			$this->load->view('login', $data);
        }
		
	}

	public function upload_cerita()
	{
		define('UPLOAD_DIR', 'gallery/');
	    $img = $_POST['imgBase64'];
	    $img = str_replace('data:image/png;base64,', '', $img);
	    $img = str_replace(' ', '+', $img);
	    $data = base64_decode($img);
	    $file = UPLOAD_DIR . uniqid() . '.png';
	    $success = file_put_contents($file, $data);
	    //send request to ocr 
	    $this->load->library('session');
	    $this->session->set_userdata('cerita_image', $file);
	    print $success ? $file : 'Unable to save the file.';
	}
	
	public function login(){

		$this->load->library('facebook'); // Automatically picks appId and secret from config
		$user = $this->facebook->getUser();

		$cerita = $this->session->userdata('cerita');
		$cerita_image = $this->session->userdata('cerita_image');
		
		$uploadphoto = $this->session->userdata('uploadphoto');
        
        $data_fb = $this->session->userdata('fb_data');

        if ($user) {
            try {
                $data_fb = $this->facebook->api('/me');
                $this->session->set_userdata('fb_data', $data_fb);				
            } catch (FacebookApiException $e) {
                $this->load->view('redirect_home');
            }
        }
        if(! $this->input->get('error'))
        {
        	$gambar_akun ='https://graph.facebook.com/'. $data_fb['id'] .'/picture';
		    if(isset($cerita))
		    {
		    	$query = $this->db->query("INSERT INTO 
					content_management(nama,jns_produk,cerita,image,email,
						notelp,alamat,provinsi,type_campaign,type_sosmed,id_akun,nama_akun,gambar_akun,created,data_stat)
					VALUES('{$cerita['nama']}','{$cerita['jns_produk']}',
						'{$cerita['cerita']}','{$cerita_image}','{$cerita['email']}'
						,'{$cerita['notelp']}','{$cerita['alamat']}','{$cerita['provinsi']}','{$cerita['type_campaign']}','facebook'
						,'{$data_fb['id']}','{$data_fb['name']}','{$gambar_akun}',now(), 1)");
		    	$this->session->unset_userdata('cerita');
		    }
		    else if(isset($uploadphoto))
		    {
		    	$query = $this->db->query("INSERT INTO 
					content_management(nama,jns_produk,image,email,
						notelp,alamat,provinsi,type_campaign,type_sosmed,id_akun,nama_akun,gambar_akun,created,data_stat)
					VALUES('{$uploadphoto['nama']}','{$uploadphoto['jns_produk']}',
						'{$uploadphoto['image']}','{$uploadphoto['email']}'
						,'{$uploadphoto['notelp']}','{$uploadphoto['alamat']}','{$uploadphoto['provinsi']}','{$uploadphoto['type_campaign']}','facebook'
						,'{$data_fb['id']}','{$data_fb['name']}','{$gambar_akun}',now(), 1)");
		    	$this->session->unset_userdata('uploadphoto');
		    }
		    $this->facebook->destroySession();
			$this->load->view('redirect_fb_success');
        }
        else
        {
        	$this->load->view('redirect_home');
        }

	}
	
	public function logincerita(){

				$data = array(
						 'id_akun' => $_POST['id'],
						'nama_akun' => $_POST['name'],
						//'link' => $user_profile['link'],
						////'emailfb' => $user_profile['email'],
						'type_sosmed' => "facebook",
						'gambar_akun' => 'https://graph.facebook.com/'. $_POST['id'] .'/picture',
						'created'=> date('Y-m-d h:m:s', NOW()),
						'n_status' => '0',
					);
				
					$query = $this->db->query("select id from content_management order by id desc limit 1");

					foreach ($query->result() as $row)
					{
					   $id = $row->id;
					   //echo $id;
					}
					//echo $where;
					$where = "id=".$id;
					$res = $this->mymodel->UpdateCeritaFacebook('content_management',$data,$where);
				
				if($res==1){
					echo '<script>alert("You Have Successfully Insert this Record!");</script>';
					echo "<script> $.magnificPopup.open({
                    items: {
                            src: '#popup-message' 
                    },
                    type: 'inline'
                }, 0);
				</script>";
					//redirect('../index.php','refresh');
					$this->uploadcerita();
					
					//echo $config['upload_path'];
				}else{
					echo "GAGAL!";
				}
			         

	}
	
	public function loginphoto(){

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
				
				$data = array(
						 'id_akun' => $data['user_profile']['id'],
						'nama_akun' => $data['user_profile']['name'],
						//'link' => $user_profile['link'],
						////'emailfb' => $user_profile['email'],
						'type_sosmed' => "facebook",
						'gambar_akun' => 'https://graph.facebook.com/'. $data['user_profile']['id'] .'/picture',
						//'created'=> date('Y-m-d', NOW()),
						'n_status' => '0',
					);
					
					$query = $this->db->query("select id from content_management order by id desc limit 1");

					foreach ($query->result() as $row)
					{
					   $id = $row->id;
					   //echo $id;
					}
					//echo $where;
					$where = "id=".$id;
					$res = $this->mymodel->UpdateCeritaFacebook('content_management',$data,$where);
				//$res = $this->mymodel->insertdataakun('data_akun',$data);
							
					//print_r($res);
				//echo $res;
				if($res==1){
					echo '<script>alert("You Have Successfully Insert this Record!");</script>';
					echo "<script> $.magnificPopup.open({
                    items: {
                            src: '#popup-message' 
                    },
                    type: 'inline'
                }, 0);
				</script>";
					//redirect('../index.php','refresh');
					$this->uploadphoto();
					
					//echo $config['upload_path'];
				}else{
					echo "GAGAL!";
				}
				
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            // Solves first time login issue. (Issue: #10)
            $this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
           /*  $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('index'), 
                'scope' => array("email") // permissions here
            )); */
			 $this->index();
        }
		 
       //$this->index();

	}

    public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('page/login');
    }
	
		
	public function landing2(){	
		$this->load->view('page/header');
		$this->load->view('page/landing2');
		$this->load->view('page/footer');
	}
	
	public function gallery(){		
		$this->load->view('page/header');
		$this->load->view('page/galeri');
		$this->load->view('page/footer');
	}
	
	public function galery($id){
	$where="where jns_produk=".$id;
	$this->load->library('pagination');
	$this->load->library('table');
	$this->load->helper('url');
	$data=array();
	$data['idcombo']=$this->uri->segment(3);
	$data['jenis_produk'] = $this->mymodel->get_dropdown_list("jenis_produk");
		
	
	$jmluser = $this->mymodel->galeri("content_management");
	$totalrows=$jmluser->num_rows();
	$id=$this->uri->segment(3);	
	$id=$id/2;
	$id=round($id);
	$id2=$id+1;
	$id3=$id2+4;
	$config['base_url'] = base_url().'page/galeri';
	$config['total_rows'] = $totalrows;
	$config['per_page'] = 16;
	$config['first_link']='Awal';
	$config['last_link']='Akhir';
	$config['prev_link']='<<';
	$config['next_link']='>>';
	$start = $this->uri->segment(3, 0);
	if($start=='')$start=1;
	
	
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
	$data['halaman']=$this->pagination->create_links();
		$data['combo']=$this->mymodel->getCombo("jenis_produk");
		$data['banners'] = $this->db->query('select * from jenis_produk')->result();
		//$data['rows']=$this->db->query('select * from content_management '.$where.' order by id desc limit '.$start.','.$config['per_page'].' ')->result();
		//$data['rows2'] = $this->db->query('select iklan from iklan '.$where.' limit '.$id2.',4 ')->result();
		//$data['rows3'] = $this->db->query('select iklan from iklan '.$where.' LIMIT '.$id3.',4 ')->result();
		$data['rowsiklan'] = $this->db->query('select *, MIN(harga) from iklan group by id asc LIMIT '.$id2.',4')->result();
		$data['rowsiklan2'] = $this->db->query('select *, MIN(harga) from iklan group by id asc limit '.$id3.',4' )->result();
		$data['rows']=$this->db->query('select * from content_management '.$where.' order by id desc')->result();
		$data['rows2'] = $this->db->query('select * from iklan '.$where)->result();
		$this->load->view('page/header');
		$this->load->view('page/galery',$data);
		$this->load->view('page/footer');
		
	}
	
	public function galeri(){	
	$this->load->library('pagination');
	$this->load->library('table');
	$this->load->helper('url');
	
	$data=array();
	$data['jenis_produk'] = $this->mymodel->get_dropdown_list("jenis_produk");
	$jmluser = $this->mymodel->galeri("content_management");
	$totalrows=$jmluser->num_rows();
	$id=$this->uri->segment(3);	
	$id=$id/2;
	$id=round($id);
	$id2=$id;
	$id3=$id2+4;
	//echo $id3;die;
	$id4=$id+4;
	$config['base_url'] = base_url().'page/gallery';
	$config['total_rows'] = $totalrows;
	$config['per_page'] = 16;
	$config['first_link']='Awal';
	$config['last_link']='Akhir';
	$config['prev_link']='<<';
	$config['next_link']='>>';
	$start = $this->uri->segment(3, 0);
	$start2=8;
	if($start=='')$start=0;
	
	//echo $start;die;
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
		$data['halaman']=$this->pagination->create_links();
		$data['combo']=$this->mymodel->getCombo("jenis_produk");
		$data['banners'] = $this->db->query('select * from jenis_produk')->result();
		$data['baner'] = $this->db->query('select * from banner order by rand() limit 1')->result();
		$data['rowsiklan'] = $this->db->query('select *, MIN(harga) from iklan group by id asc LIMIT '.$id2.',4')->result();
		$data['rows']=$this->db->query('select * from content_management where data_stat=1 order by id desc limit '.$start.',8')->result();
		$data['rowsiklan2'] = $this->db->query('select *, MIN(harga) from iklan group by id asc limit '.$id3.',4' )->result();
		$data['rows4']=$this->db->query('select * from content_management  order by id desc limit '.$start2.',8')->result();
		$data['rowsiklan3'] = $this->db->query('select * from iklan order by harga asc LIMIT '.$id4.',4')->result();
		$this->load->view('page/header');
		$this->load->view('page/gallery',$data);
		$this->load->view('page/footer');
	}
	
	public function galeriy($ids){
	$where="where jns_produk=".$ids;		
	$this->load->library('pagination');
	$this->load->library('table');
	$this->load->helper('url');
	
	$data=array();
	$data['jenis_produk'] = $this->mymodel->get_dropdown_list("jenis_produk");
	$jmluser = $this->mymodel->galeri("content_management");
	$totalrows=$jmluser->num_rows();
	$id=$this->uri->segment(3);	
	$id=$id/2;
	$id=round($id);
	$id2=0;
	$id3=$id2+4;
	//echo $id2;die;
	$id4=$id+4;
	$config['base_url'] = base_url().'page/galeri';
	$config['total_rows'] = $totalrows;
	$config['per_page'] = 16;
	$config['first_link']='Awal';
	$config['last_link']='Akhir';
	$config['prev_link']='<<';
	$config['next_link']='>>';
	$start = $this->uri->segment(3, 0);
	$start = 0;
	$start2=8;
	if($start=='')$start=0;
	
	//echo $ids; die;
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
		$data['halaman']=$this->pagination->create_links();
		$data['combo']=$this->mymodel->getCombo("jenis_produk");
		$data['banners'] = $this->db->query('select * from jenis_produk')->result();
		$data['baner'] = $this->db->query('select * from banner where id_produk='.$ids.'')->result();
		$data['rowsiklan'] = $this->db->query('select *, MIN(harga) from iklan '.$where.' group by id asc LIMIT '.$id2.',4')->result();
		$data['rows']=$this->db->query('select * from content_management '.$where.'  order by id desc limit '.$start.',8')->result();
		$data['rowsiklan2'] = $this->db->query('select *, MIN(harga) from iklan '.$where.' group by id asc limit '.$id3.',4' )->result();
		$data['rows4']=$this->db->query('select * from content_management '.$where.'  order by id desc limit '.$start2.',8')->result();
		//$data['rowsiklan3'] = $this->db->query('select * from iklan order by harga asc LIMIT '.$id4.',4')->result();
		$this->load->view('page/header');
		$this->load->view('page/galeri',$data);
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
	
	public function uploadcerita1(){	
	$this->load->library('facebook'); // Automatically picks appId and secret from config
    
		$data['combo']=$this->mymodel->getCombo("jenis_produk");
		$data['rows']=$this->db->query('select * from content_management where data_stat=1 order by id desc')->result();
		$this->load->view('page/header');
		$this->load->view('page/fb');
		$this->load->view('page/uploadcerita1',$data);		
		$this->load->view('page/footer');
	}
	
	
	public function uploadcerita(){	

		$data['display_success'] = false;
		if($this->input->get('success'))
		{
			$data['display_success'] = true;
		}
		$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));
		$data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('page/login'), 
                'scope' => array("email") // permissions here
            ));

		$data['combo']=$this->mymodel->getCombo("jenis_produk");
		$data['provinsi']=$this->mymodel->getCombo1("provinsi");
		$data['rows']=$this->db->query('select * from content_management where n_status=1 and data_stat=1 order by id desc')->result();
		$this->load->view('page/header');
		$this->load->view('page/uploadcerita',$data);
		//$this->load->view('page/fb');
		$this->load->view('page/footer');
	}
	
	public function uploadceritanew(){	
	
		
	
		$this->load->view('page/header');
		$this->load->view('page/uploadceritanew');
		$this->load->view('page/footer');
	}
	
	public function uploadphoto(){	
	$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));
		// $user = $this->facebook->getUser();
        
  //       if ($user) {
  //           try {
  //               $data['user_profile'] = $this->facebook->api('/me');				
  //           } catch (FacebookApiException $e) {
  //               $user = null;
  //           }
  //       }else {
  //           // Solves first time login issue. (Issue: #10)
  //           //$this->facebook->destroySession();
  //       }

  //       if ($user) {

  //           $data['logout_url'] = site_url('welcome/logout'); // Logs off application
  //           // OR 
  //           // Logs off FB!
  //           // $data['logout_url'] = $this->facebook->getLogoutUrl();

  //       } else {
  //           $data['login_url'] = $this->facebook->getLoginUrl(array(
  //               'redirect_uri' => site_url('page/login'), 
  //               'scope' => array("email") // permissions here
  //           ));
  //       }

        $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('page/login'), 
                'scope' => array("email") // permissions here
            ));
		$data['provinsi']=$this->mymodel->getCombo1("provinsi");
		$data['rows']=$this->db->query('select * from content_management where n_status=1 and data_stat=1 order by id desc')->result();
		$this->load->view('page/header');
		$this->load->view('page/uploadphoto',$data);
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
			$this->index();			
		}else{
			echo "GAGAL!!!";
		} 
	}
	
	
	public function insertphoto(){
		
			
			$nama = $_POST['nama'];
			$telp = $_POST['tlpn'];
			$email = $_POST['email'];
			$imagecrop = $_POST['imagecrop'];
			$produk = $_POST['produk'];
			$alamat = $_POST['alamat'];
			$provinsi = $_POST['provinsi'];
			
			$gambar = "http://lgindonesia.com/lgforyou/image/header.jpg";
			$facebook = "http://lgindonesia.com/lgforyou/image/facebook.png";
			$twitter = "http://lgindonesia.com/lgforyou/image/instagram.png";
			$instagram = "http://lgindonesia.com/lgforyou/image/twitter.png";
			
			$data = array(
						 'nama' => $nama,
						 'notelp' => $telp,
						 'alamat' => $alamat,
						 'provinsi' => $provinsi,
						 'email' => $email,
						 'type_campaign' => 'gambar',
						 'image' => $imagecrop,
						 'jns_produk' => $produk,
						 'n_status' => 0,
						 'created'=> date('Y-m-d h:m:s', NOW())
					);
			$this->load->library('session');
			$this->session->set_userdata('uploadphoto', $data);
			// $res = $this->mymodel->upload_foto('content_management',$data);
							
					//print_r($res);
				//echo $res;
				// if($res==1){
				// 	echo '<script>alert("You Have Successfully Insert this Record!");</script>';
				// 	redirect('../Page/uploadphoto','refresh');
				// 	//echo $config['upload_path'];
				// }else{
				// 	echo "GAGAL!";
				// }
			$link= strtr(base64_encode($email), '+/=', '-_,');
			//$link= urlencode(base64_encode($email));
			$link2 = base_url()."page/status/".$link;
			
			$template ="<div style='padding:40px; background:#f6f6f6; font-family:arial; line-height:26px; font-size:14px; color:#5d6770;'>
						<div style='max-width:600px; margin:0 auto;  background:#fff;'>
							<img src='".$gambar."' style='width:100%; height:auto;'>
							<div style='padding:30px;'>
								<h3 style='margin:0; font-weight:normal;'>Hi, ".$nama."</h3>

								<p>Karya Anda telah kami terima dan akan melalui proses moderasi.</p>

								<p>Terima kasih telah berpartisipasi dalam rangka merayakan 25 tahun ulang tahun LG bersama kami di <a style='color:#c3034c; text-decoration:none;'>#LGForYou</a></p>
							</div>
						</div>
						<div style='max-width:600px; margin:0 auto; padding:20px 0; text-align:center;'>
							<div>
								<a href='facebook.com/lgeindonesia' target='_blank' style='margin:0 2px;'><img src='".$facebook."'></a>
								<a href='twitter.com/lgeindonesia' target='_blank' style='margin:0 2px;'><img src='".$instagram."'></a>
								<a href='instagram.com/lgeindonesia' target='_blank' style='margin:0 2px;'><img src='".$twitter."'></a>
							</div>
							<p style='font-size:12px; margin:0 0 10px 0;'>Copyright &copy; 2015 LG Electronics. All Rights Reserved.</p>
						</div>
					</div>";
                        
			
				
			//$template .= base_url()."page/status/".$link;
			$template .= '</div>';
			
			
			$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';
		
			///Send Email
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
					  'https://api.mailgun.net/v3/lgforyou.com/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
							array('from' => 'LG For You<no-reply@lgforyou.com>',
								  'to' => $email,
								  'subject' => 'LG For You Submission',
								  'html' => $template));
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
				
			//}
		
	}
	
	function insertceritanew(){
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
			'data_stat' => '0',
			'created' => date('Y-m-d h:m:s', NOW())
		);
		//print_r($data);
		$res = $this->db->insert('content_management',$data);
		if($res>=1){
			//echo '<script>alert("You Have Successfully Insert this Record!");</script>';
			redirect('','refresh');
		}else{
			echo "GAGAL!";
		}
	}
	
	function insertcerita(){
		
		//echo var_dump($_POST);exit;
		$nama = $_POST['nama'];
		$notelp = $_POST['tlpn'];
		$email = $_POST['email'];
		$jenis = $_POST['produk'];
		$cerita = $_POST['kesan'];
		$alamat = $_POST['alamat'];
		$provinsi = $_POST['provinsi'];
		//echo $alamat; die;
		
		$gambar = "http://lgindonesia.com/lgforyou/image/header.jpg";
		$facebook = "http://lgindonesia.com/lgforyou/image/facebook.png";
		$twitter = "http://lgindonesia.com/lgforyou/image/instagram.png";
		$instagram = "http://lgindonesia.com/lgforyou/image/twitter.png";
		
		//$created = 'now()';
		$data = array(
			'nama' => $nama,
			'notelp' => $notelp,
			'email' => $email,
			'jns_produk' => $jenis,
			'cerita' => $cerita,
			'alamat' => $alamat,
			'provinsi' => $provinsi,
			'type_campaign' => 'cerita',
			'n_status' => '0',
			'data_stat' => '1',
			'created' => date('Y-m-d h:m:s', NOW())
		);
		//print_r($data); die;

		$this->load->library('session');
		$this->session->set_userdata('cerita', $data);
		
		$link= strtr(base64_encode($email), '+/=', '-_,');
			//$link= urlencode(base64_encode($email));
			//$link2 = "lg.kanadigital.com/public/page/galeri/";
			$link2 = "lgindonesia.com/lgforyou/page/galeri/";
			
			$template ="<div style='padding:40px; background:#f6f6f6; font-family:arial; line-height:26px; font-size:14px; color:#5d6770;'>
						<div style='max-width:600px; margin:0 auto;  background:#fff;'>
							<img src='".$gambar."' style='width:100%; height:auto;'>
							<div style='padding:30px;'>
								<h3 style='margin:0; font-weight:normal;'>Hi, ".$nama."</h3>

								<p>Karya Anda telah kami terima dan akan melalui proses moderasi.</p>

                                                                <p>Terima kasih telah berpartisipasi dalam rangka merayakan 25 tahun ulang tahun LG bersama kami di <a style='color:#c3034c; text-decoration:none;'>#LGForYou</a></p>
							</div>
						</div>
						<div style='max-width:600px; margin:0 auto; padding:20px 0; text-align:center;'>
							<div>
								<a href='facebook.com/lgeindonesia' target='_blank' style='margin:0 2px;'><img src='".$facebook."'></a>
								<a href='twitter.com/lgeindonesia' target='_blank' style='margin:0 2px;'><img src='".$instagram."'></a>
								<a href='instagram.com/lgeindonesia' target='_blank' style='margin:0 2px;'><img src='".$twitter."'></a>
							</div>
							<p style='font-size:12px; margin:0 0 10px 0;'>Copyright &copy; 2015 LG Electronics. All Rights Reserved.</p>
						</div>
					</div>";
          	
			//$template .= $link2;
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
					  'https://api.mailgun.net/v3/lgforyou.com/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
							array('from' => 'LG For You<no-reply@lgforyou.com>',
								  'to' => $email,
								  'subject' => 'LG For You Submission',
								  'html' => $template));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			
			$res2 = json_decode($result,TRUE);

		//print_r($data);
		// $res = $this->db->insert('content_management',$data);
		// $link= strtr(base64_encode($email), '+/=', '-_,');
		// 	//$link= urlencode(base64_encode($email));
		// 	$link2 = base_url()."page/status/".$link;
			
		// 	$template =' <div style=" background:#730000; color:#fff; padding:40px 30px; font-family:sans-serif; line-height: 24px;">
  //                       <p>Hai, </p>
  //                       <p>Anda diundang untuk bergabung dengan <strong style="color:#fdcb02;">LG Digital</strong>.<br><a style="color:#fdcb02; text-decoration:none;" target="blank
  //                       " href='.$link2.'>Klik disini</a> untuk bergabung.<br>
  //                       Jika anda tidak bisa klik link di atas, copy link di bawah ini ke browser<br><span style="color:#fdcb02;"></span></p>';
                        
                       
			
				
		// 	$template .= base_url()."page/status/".$link;
		// 	$template .= '</div>';
		// 	$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';
			
		
		// 	///Send Email
		// 	$ch = curl_init();
		// 	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		// 	curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		// 	curl_setopt($ch, CURLOPT_URL, 
		// 			  'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
		// 	curl_setopt($ch, CURLOPT_POSTFIELDS, 
		// 					array('from' => 'LG Digital<sscr-admin@LGDigital.co.id>',
		// 						  'to' => $email,
		// 						  'subject' => 'Registrasi Member ',
		// 						  'html' => $template,
		// 						  'o:campaign' => 'fkdf5'));
		// 	$result = curl_exec($ch);
		// 	$info = curl_getinfo($ch);
			
		// 	$res2 = json_decode($result,TRUE);	
		// if($res>=1){
		// 	echo '<script>alert("You Have Successfully Insert this Record!");</script>';
		// 	redirect('Page/uploadcerita','refresh');
		// }else{
		// 	echo "GAGAL!";
		// }
	}
	
	public function galeri1()
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

	
	$data['rows']=$this->db->query('select * from content_management where data_stat=1 limit '.$start.','.$config['per_page'].'  ')->result();
	$data['rows2'] = $this->db->query('select iklan from iklan limit '.$id2.',4 ')->result();
	$data['rows3'] = $this->db->query('select iklan from iklan LIMIT '.$id3.',4')->result();
	
	$this->load->view('galeri', $data);
	}
	
	function img_save_to_file(){
		$this->load->view('page/img_save_to_file');
	}
	
	public function twitter_auth()
	{
		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			$this->load->library('session');
			$cerita = $this->session->userdata('cerita');
			$cerita_image = $this->session->userdata('cerita_image');
			$uploadphoto = $this->session->userdata('uploadphoto');
			$data_twitter = $this->session->userdata('data_twitter');
			// User is already authenticated. Add your user notification code here.
			if(isset($cerita))
		    {
		    	$query = $this->db->query("INSERT INTO 
				content_management(nama,jns_produk,cerita,image,email,
					notelp,alamat,provinsi,type_campaign,type_sosmed,id_akun,nama_akun,gambar_akun,created,data_stat)
				VALUES('{$cerita['nama']}','{$cerita['jns_produk']}',
					'{$cerita['cerita']}','{$cerita_image}','{$cerita['email']}'
					,'{$cerita['notelp']}','{$cerita['alamat']}','{$cerita['provinsi']}','{$cerita['type_campaign']}','twitter'
					,'{$data_twitter->id}','{$data_twitter->name}'
					,'{$data_twitter->profile_image_url_https}',now(), 1)");

		    	$this->session->unset_userdata('cerita');
		    }
		    else if(isset($uploadphoto))
		    {
		    	$query = $this->db->query("INSERT INTO 
				content_management(nama,jns_produk,image,email,
					notelp,alamat,provinsi,type_campaign,type_sosmed,id_akun,nama_akun,gambar_akun,created,data_stat)
				VALUES('{$uploadphoto['nama']}','{$uploadphoto['jns_produk']}',
					'{$uploadphoto['image']}','{$uploadphoto['email']}'
					,'{$uploadphoto['notelp']}','{$uploadphoto['alamat']}','{$uploadphoto['provinsi']}','{$uploadphoto['type_campaign']}','twitter'
					,'{$data_twitter->id}','{$data_twitter->name}'
					,'{$data_twitter->profile_image_url_https}',now(), 1)");
		    	$this->session->unset_userdata('uploadphoto');
		    }
			$this->load->view('redirect_fb_success');
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('/page/twitter'));

			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
			
			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				redirect($url);
			}
			else
			{
				// An error occured. Make sure to put your error notification code here.
				redirect(base_url('/'));
			}
		}
	}

	public function twitter() {
		if(!$this->input->get('denied'))
		{
			$this->load->library('session');
			$cerita = $this->session->userdata('cerita');
			$cerita_image = $this->session->userdata('cerita_image');
			$uploadphoto = $this->session->userdata('uploadphoto');

			if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
			{
				$this->reset_session();
				redirect(base_url('/page/twitter_auth'));
			}
			else
			{
				$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
				$data_twitter = $this->connection->get("account/verify_credentials");
				$this->session->set_userdata('data_twitter', $data_twitter);

				if ($this->connection->http_code == 200)
				{
					// $this->session->set_userdata('access_token', $access_token['oauth_token']); //set session dengan isi akses token
					// $this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
					// $this->session->set_userdata('twitter_user_id', $access_token['user_id']); //set session dengan isi id user
					// $this->session->set_userdata('twitter_screen_name', $access_token['screen_name']); //set session dengan isi username

					$this->session->unset_userdata('request_token');
					$this->session->unset_userdata('request_token_secret');
					if(isset($cerita))
				    {
				    	$query = $this->db->query("INSERT INTO 
						content_management(nama,jns_produk,cerita,image,email,
							notelp,alamat,provinsi,type_campaign,type_sosmed,id_akun,nama_akun,gambar_akun,created,data_stat)
						VALUES('{$cerita['nama']}','{$cerita['jns_produk']}',
							'{$cerita['cerita']}','{$cerita_image}','{$cerita['email']}'
							,'{$cerita['notelp']}','{$cerita['alamat']}','{$cerita['provinsi']}','{$cerita['type_campaign']}','twitter'
							,'{$data_twitter->id}','{$data_twitter->name}'
							,'{$data_twitter->profile_image_url_https}',now(), 1)");

				    	$this->session->unset_userdata('cerita');
				    }
				    else if(isset($uploadphoto))
				    {
				    	$query = $this->db->query("INSERT INTO 
						content_management(nama,jns_produk,image,email,
							notelp,alamat,provinsi,type_campaign,type_sosmed,id_akun,nama_akun,gambar_akun,created,data_stat)
						VALUES('{$uploadphoto['nama']}','{$uploadphoto['jns_produk']}',
							'{$uploadphoto['image']}','{$uploadphoto['email']}'
							,'{$uploadphoto['notelp']}','{$uploadphoto['alamat']}','{$uploadphoto['provinsi']}','{$uploadphoto['type_campaign']}','twitter'
							,'{$data_twitter->id}','{$data_twitter->name}'
							,'{$data_twitter->profile_image_url_https}',now(), 1)");
				    	$this->session->unset_userdata('uploadphoto');
				    }
					$this->load->view('redirect_fb_success');

				}
				else
				{
					// An error occured. Add your notification code here.
					redirect(base_url('/page/twitter_auth'));
				}
			}
		}
		else
		{
			$this->load->view('redirect_home');
		}
		
	}

	/* redirect to Twitter for authentication */
	public function redirect() {
		$this->load->library('twconnect');

		/* twredirect() parameter - callback point in your application */
		/* by default the path from config file will be used */
		$ok = $this->twconnect->twredirect('page/callback');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}


	/* return point from Twitter */
	/* you have to call $this->twconnect->twprocess_callback() here! */
	public function callback() {
		$this->load->library('twconnect');

		$ok = $this->twconnect->twprocess_callback();
		
		if ( $ok ) { redirect('page/success'); }
			else redirect ('page/failure');
	}


	/* authentication successful */
	/* it should be a different function from callback */
	/* twconnect library should be re-loaded */
	/* but you can just call this function, not necessarily redirect to it */
	public function success() {
		//echo 'Twitter connect succeded<br/>';
		//echo '<p><a href="' . base_url() . 'page/clearsession">Do it again!</a></p>';

		$this->load->library('twconnect');

		// saves Twitter user information to $this->twconnect->tw_user_info
		// twaccount_verify_credentials returns the same information
		$this->twconnect->twaccount_verify_credentials();

		//echo 'Authenticated user info ("GET account/verify_credentials"):<br/><pre>';
		//print_r($this->twconnect->tw_user_info); echo '</pre>';
		//echo '<pre>';
		//echo $this->twconnect->tw_user_info->name;
		//echo '</pre>';
		
		
		
		  // $data = array( 		
		  
				// 		 'nama_akun' => $this->twconnect->tw_user_info->name,						 
				// 		 'type_sosmed' => 'twitter',
				// 		 'data_stat' => '0',
				// 		 'n_status' => '0',
				// 		 'id_akun' => $this->twconnect->tw_user_info->id,
				// 		 'gambar_akun' =>$this->twconnect->tw_user_info->profile_image_url_https,

				// 	);
					
				// 	$query = $this->db->query("select id from content_management order by id desc limit 1");

				// 	foreach ($query->result() as $row)
				// 	{
				// 	   $id = $row->id;
				// 	   //echo $id;
				// 	}
				// 	//echo $where;
				// 	$where = "id=".$id;
					
				// 	$res = $this->mymodel->UpdateCeritaTwitter('content_management',$data,$where);
				//$res = $this->mymodel->insertdataakun('data_akun',$data);
							
					//print_r($res);
				//echo $res;
			$this->load->library('session');
			$cerita = $this->session->userdata();

			$query = $this->db->query("INSERT INTO 
				content_management(nama,jns_produk,cerita,email,
					notelp,alamat,provinsi,type_campaign,type_sosmed,id_akun,nama_akun,gambar_akun,created,data_stat)
				VALUES('{$cerita['nama']}','{$cerita['jns_produk']}',
					'{$cerita['cerita']}','{$cerita['email']}'
					,'{$cerita['notelp']}','{$cerita['alamat']}','{$cerita['provinsi']}','{$cerita['type_campaign']}','twitter'
					,'{$this->twconnect->tw_user_info->id}','{$this->twconnect->tw_user_info->name}'
					,'{$this->twconnect->tw_user_info->profile_image_url_https}',now(), 1)");

			$this->load->view('redirect_fb_success');
				
	}


	/* authentication un-successful */
	public function failure() {

		echo '<p>Twitter connect failed</p>';
		//echo '<p><a href="' . base_url() . 'page/clearsession">Try again!</a></p>';
		//$this->clearsession();
		redirect('/page/clearsession');
	}


	/* clear session */
	public function clearsession() {

		$this->session->sess_destroy();

		redirect('/page/twitter');
	}
	
	

	function pages(){
		//echo 'sss';die;
		$pdo = $this->connect();
		//$jenis = $_POST['jenis'];
		$lastidiklan = $_POST['lastidiklan'];
		$lastidcontent = $_POST['lastidcontent'];
		$limit = 8; // default value
		//echo $jenis;die;
		if (isset($_POST['limit'])) {
			$limit = intval($_POST['limit']);
		}
		$limitiklan = 4;
		$limitcontent = 8;

		// select items for page params
		try {
			$sqliklan = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' group by id LIMIT 0, '.$limitiklan.'';
			//echo $sqliklan; die;
			$sqlcontent = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			//echo $sqlcontent;die;
			$queryiklan = $pdo->prepare($sqliklan);
			$querycontent = $pdo->prepare($sqlcontent);
			$queryiklan->bindParam(':lastidiklan', $lastidiklan, PDO::PARAM_INT);
			$querycontent->bindParam(':lastidcontent', $lastidcontent, PDO::PARAM_INT);
			$queryiklan->bindParam(':limitiklan', $limitiklan, PDO::PARAM_INT);
			$querycontent->bindParam(':limitcontent', $limitcontent, PDO::PARAM_INT);
			$queryiklan->execute();
			$querycontent->execute();
			$rows = $querycontent->fetchAll();
			$rowsiklan = $queryiklan->fetchAll();
		} catch (PDOException $e) {
			echo 'PDOException : '.  $e->getMessage();
		}
		
		$lastidiklan = 0;
		$lastidcontent = 0;
		foreach ($rowsiklan as $rowiklan){
			$lastidiklan = $rowiklan['id'];
						echo "<div class='productList'>
							<div class='items-product'>
								<div class='itemContainer'>
									<div class='entry'>
										<span class='productshop thumb'>
											
											<td><img alt='example2' src='".base_url()."iklan/".$rowiklan['iklan']."' border='0' width='200'></td>
										</span>
									</div>
									<div class='meta'>
										<div class='product-title'><span>".$rowiklan['nama']."</span></div>
										<div class='price'>
											<span class='discount'>".$rowiklan['hrg_diskon']."</span>
											<span>".$rowiklan['harga']."</span>
										</div>										
									</div>
								</div>
							</div>
						</div>";
					}
				?>
				<!-- End Iklan pertama -->
				
				<table width="100%">
					<tr><td>&nbsp;</td></tr>
				</table>
	
                <div class="galleryLists">
                    <?php 
						$i=1;
						foreach ($rows as $row) {
						$lastidcontent = $row['id'];							
							if ($row['type_sosmed']=='twitter'){ ?>
							 <div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-twitter"></i>
									<div class="entry">
										<span class="photo-entry-text thumb">
											<?php 
											
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
																			
											?>
										</span>
									</div>
									<div class="meta">
										<div class="thumb thumb-small"><?php echo "<img src='".$row['gambar_akun']."'/>" ?></div>
										<div class="userdetail">
											<span class="username"><?php echo $row['id_akun']; ?></span>
											<span class="userID"><?php echo $row['nama_akun']; ?></span>
										</div>
									</div>
									<div class="sharebox">
										<div class="sharebox-entry">
											<h3>SHARE</h3>
										   <?php
										
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['image']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row['image']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										  
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
							<?php }
					
							else{ ?>
							<div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-facebook"></i>
									<div class="entry">
										<span class="photo-entry-text thumb">
											<?php 
											
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
																			
											?>
										</span>
									</div>
									<div class="meta">
											<div class="thumb thumb-small"><?php echo "<img src='".$row['gambar_akun']."'/>" ?></div>
											<div class="userdetail">
												<span class="username"><?php echo $row['id_akun']; ?></span>
												<span class="userID"><?php echo $row['nama_akun']; ?></span>
											</div>
									</div>
									<div class="sharebox">
										<div class="sharebox-entry">
											<h3>SHARE</h3>
											<?php
										
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['image']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita',''http://lgindonesia.com/lgforyou/page/<?php echo $row['image']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
					 
							<?php } 
						$i++;
						}

		if ($lastidiklan != 0 && $lastidcontent !=0) {
			echo '<script type="text/javascript">var lastidiklan = '.$lastidiklan.';
			var lastidcontent = '.$lastidcontent.'</script>';
		}

		// sleep for 1 second to see loader, it must be deleted in prodection
		sleep(1);

	}
	
	function pagesnew(){
		//echo 'sss';die;
		$pdo = $this->connect();
		$jenis = $_POST['jenis'];
		$lastidiklan = $_POST['lastidiklan'];
		$lastidcontent = $_POST['lastidcontent'];
		$limit = 8; // default value
		//echo $jenis;die;
		if (isset($_POST['limit'])) {
			$limit = intval($_POST['limit']);
		}
		$limitiklan = 4;
		$limitcontent = 8;

		// select items for page params
		try {
			$sql = 'select id from iklan where jns_produk='.$jenis.' group by id desc limit 1';
			$q = $pdo->prepare($sql);
			$q->execute();
			$qq = $q->fetchAll();
			foreach ($qq as $qqq){
			$re = $qqq['id'];
			}
			if($re!=$lastidiklan){
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' and jns_produk='.$jenis.' group by id LIMIT 0, '.$limitiklan.'';
			}else{
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id < '.$lastidiklan.' and jns_produk='.$jenis.' group by id LIMIT 0, '.$limitiklan.'';
			}
			$sqliklan = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' and jns_produk='.$jenis.' group by id LIMIT 0, '.$limitiklan.'';
			$sqlcontent = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and jns_produk='.$jenis.' ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			//echo $sql1; die;
			//echo $sqlcontent;die;
			$queryiklan = $pdo->prepare($sql1);
			$querycontent = $pdo->prepare($sqlcontent);
			$queryiklan->bindParam(':lastidiklan', $lastidiklan, PDO::PARAM_INT);
			$querycontent->bindParam(':lastidcontent', $lastidcontent, PDO::PARAM_INT);
			$queryiklan->bindParam(':limitiklan', $limitiklan, PDO::PARAM_INT);
			$querycontent->bindParam(':limitcontent', $limitcontent, PDO::PARAM_INT);
			$queryiklan->execute();
			$querycontent->execute();
			$rows = $querycontent->fetchAll();
			$rowsiklan = $queryiklan->fetchAll();
		} catch (PDOException $e) {
			echo 'PDOException : '.  $e->getMessage();
		}
		
		$lastidiklan = 0;
		$lastidcontent = 0;
		foreach ($rowsiklan as $rowiklan){
			$lastidiklan = $rowiklan['id'];
						echo "<div class='productList'>
							<div class='items-product'>
								<div class='itemContainer'>
									<div class='entry'>
										<span class='productshop thumb'>
											
											<td><img alt='example2' src='".base_url()."iklan/".$rowiklan['iklan']."' border='0' width='200'></td>
										</span>
									</div>
									<div class='meta'>
										<div class='product-title'><span>".$rowiklan['nama']."</span></div>
										<div class='price'>
											<span class='discount'>".$rowiklan['hrg_diskon']."</span>
											<span>".$rowiklan['harga']."</span>
										</div>										
									</div>
								</div>
							</div>
						</div>";
					}
				?>
				<!-- End Iklan pertama -->
				
				<table width="100%">
					<tr><td>&nbsp;</td></tr>
				</table>
	
                <div class="galleryLists">
                    <?php 
						$i=1;
						foreach ($rows as $row) {
						$lastidcontent = $row['id'];							
							if ($row['type_sosmed']=='twitter'){ ?>
							 <div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-twitter"></i>
									<div class="entry">
										<span class="photo-entry-text thumb">
											<?php 
											if ($row['cerita']){
											echo "<img src='".base_url()."page/".$row['cerita']."' border='0' width='160'>"; 
											}else{
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
											}								
											?>
										</span>
									</div>
									<div class="meta">
										<div class="thumb thumb-small"><?php echo "<img src='".$row['gambar_akun']."'/>" ?></div>
										<div class="userdetail">
											<span class="username"><?php echo $row['id_akun']; ?></span>
											<span class="userID"><?php echo $row['nama_akun']; ?></span>
										</div>
									</div>
									<div class="sharebox">
										<div class="sharebox-entry">
											<h3>SHARE</h3>
										   <?php
										if ($row['cerita']){
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['cerita']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row['cerita']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
											if ($row['image']){
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['image']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row['image']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
										   ?>
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
							<?php }
					
							else{ ?>
							<div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-facebook"></i>
									<div class="entry">
										<span class="photo-entry-text thumb">
											<?php 
											if ($row['cerita']){
											echo "<img src='".base_url()."page/".$row['cerita']."' border='0' width='160'>"; 
											}else{
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
											}								
											?>
										</span>
									</div>
									<div class="meta">
											<div class="thumb thumb-small"><?php echo "<img src='".$row['gambar_akun']."'/>" ?></div>
											<div class="userdetail">
												<span class="username"><?php echo $row['id_akun']; ?></span>
												<span class="userID"><?php echo $row['nama_akun']; ?></span>
											</div>
									</div>
									<div class="sharebox">
										<div class="sharebox-entry">
											<h3>SHARE</h3>
											<?php
										if ($row['cerita']){
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['cerita']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row['cerita']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
											if ($row['image']){
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['image']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row['image']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
										   ?>
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
					 
							<?php } 
						$i++;
						}

		if ($lastidiklan != 0 && $lastidcontent !=0) {
			echo '<script type="text/javascript">var lastidiklan = '.$lastidiklan.';
			var lastidcontent = '.$lastidcontent.'</script>';
		}

		// sleep for 1 second to see loader, it must be deleted in prodection
		sleep(1);

	}	
	
	
	function connect() {
		$host = '202.80.113.116';
		$db_name = 'db_lg';
		$db_user = 'root';
		$db_password = 'coppermine';
		return new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
}
?>
