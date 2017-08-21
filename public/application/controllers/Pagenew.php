<?php
class Pagenew extends CI_Controller {
 
	 public function __construct(){
	 
		 parent::__construct();
		 
		 parse_str($_SERVER['QUERY_STRING'],$_REQUEST);
		 
		 $this->load->library('Facebook', array("appId"=>"533895273426413", "secret"=>"d5801507ff7b26b5044960cf8c8a6e85"));
		 
		 $this->user = $this->facebook->getUser();
	 
	 }
 
	 public function uploadceritanew() {
	 
		 if($this->user) {
		 
			 try{
			 
				 $user_profile = $this->facebook->api('/me?fields=id,name,link,email');
				 
				 
				 //echo "<pre>"; print_r($user_profile);
				 //echo "<br>";
				 //echo $user_profile['id'];
				 //echo $user_profile['name'];
				 
				 $data = array(
					'id_akun' => $user_profile['id'],
					'nama_akun' => $user_profile['name'],
					//'link' => $user_profile['link'],
					////'emailfb' => $user_profile['email'],
					'type_sosmed' => "facebook",
					'gambar_akun' => 'https://graph.facebook.com/'. $user_profile['id'] .'/picture',
					//'created'=> date('Y-m-d', NOW()),
					'n_status' => '1',
				 );
				 
				 $query = $this->db->query("select id from content_management order by id desc limit 1");

					foreach ($query->result() as $row)
					{
					   $id = $row->id;
					   //echo $id;
					}
					//echo $where;
					$where = "id=".$id;
					//echo $where;
				 $res = $this->mymodel->UpdateCeritaFacebook('content_management',$data,$where);
				/* if($res==1){
					redirect('','refresh');
				}else {
					echo "alert('GAGAL!!!')";
				} */
				 
				echo "<pre>"; print_r($data);
				 
			}
			catch(FacebookApiException $e){
				 
				 print_r($e);				 
				 $user = null;			 
			 }
		 }
	 
		 if($this->user){
		 
			 $logout = $this->facebook->getLogouturl(array("next"=>base_url()."pagenew/logout"));
			 echo '<img src="https://graph.facebook.com/'. $user_profile['id'] .'/picture" width="30" height="30"/><br>';
			 echo "<a href='$logout'>Logout</a>";
		 
		 }else{
		 
			 $data['url'] = $login = $this->facebook->getLoginUrl(array("scope"=>"email"));
			 $this->load->view('page/header');
			 $this->load->view('page/uploadceritanew', $data);
			 $this->load->view('page/footer');
			// $this->load->view('login', $data);
		 
		 }
		 
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
			'created' => date('Y-m-d', NOW())
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
	 
	 public function logout() {
	 
		 session_destroy();
		 
		 redirect(base_url().'pagenew/uploadceritanew');
	 
	 }
	 
	 public function twitter() {
		$this->load->library('twconnect');

		//echo '<p><a href="' . base_url() . 'page/redirect">Connect to Twitter</a></p>';
		//echo '<p><a href="' . base_url() . 'page/clearsession">Clear session</a></p>';

		echo 'Session data:<br/><pre>';
		print_r($this->session->all_userdata());
		echo '</pre>';
		$this->redirect();
	}

	/* redirect to Twitter for authentication */
	public function redirect() {
		$this->load->library('twconnect');

		/* twredirect() parameter - callback point in your application */
		/* by default the path from config file will be used */
		$ok = $this->twconnect->twredirect('pagenew/callback');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}


	/* return point from Twitter */
	/* you have to call $this->twconnect->twprocess_callback() here! */
	public function callback() {
		$this->load->library('twconnect');

		$ok = $this->twconnect->twprocess_callback();
		
		if ( $ok ) { redirect('pagenew/success'); }
			else redirect ('pagenew/failure');
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
		
		
		
		  $data = array( 		
		  
						 'nama_akun' => $this->twconnect->tw_user_info->name,						 
						 'type_sosmed' => 'twitter',
						 'id_akun' => $this->twconnect->tw_user_info->id,
						 'gambar_akun' =>$this->twconnect->tw_user_info->profile_image_url_https,
						 //'email' => 'fauzi.rahman@kana.co.id'
						 
					);
					
					$query = $this->db->query("select id from content_management order by id desc limit 1");

					foreach ($query->result() as $row)
					{
					   $id = $row->id;
					   //echo $id;
					}
					//echo $where;
					$where = "id=".$id;
					//echo $where;die;
				$res = $this->mymodel->UpdateCeritaTwitter('content_management',$data,$where);
							
					//print_r($res);
				//echo $res;
				if($res==1){
					echo '<script>alert("You Have Successfully Insert this Record!");</script>';
					redirect('','refresh');
					//$this->index();
					//echo $config['upload_path'];
				}else{
					echo "GAGAL!";
				}
		
	}


	/* authentication un-successful */
	public function failure() {

		echo '<p>Twitter connect failed</p>';
		//echo '<p><a href="' . base_url() . 'page/clearsession">Try again!</a></p>';
		//$this->clearsession();
		redirect('/pagenew/clearsession');
	}


	/* clear session */
	public function clearsession() {

		$this->session->sess_destroy();

		redirect('/pagenew/twitter');
	}
}
?>