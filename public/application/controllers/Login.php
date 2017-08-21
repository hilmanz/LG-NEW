<?php
class login extends CI_Controller {
 
	 public function __construct(){
	 
		 parent::__construct();
		 
		 parse_str($_SERVER['QUERY_STRING'],$_REQUEST);
		 
		 $this->load->library('Facebook', array("appId"=>"533895273426413", "secret"=>"d5801507ff7b26b5044960cf8c8a6e85"));
		 
		 $this->user = $this->facebook->getUser();
	 
	 }
 
	 public function index() {
	 
		 if($this->user) {
		 
			 try{
			 
				 $user_profile = $this->facebook->api('/me?fields=id,name,link,email');
				 
				 
				 //echo "<pre>"; print_r($user_profile);
				 //echo "<br>";
				 //echo $user_profile['id'];
				 //echo $user_profile['name'];
				 
				 $data = array(
					'idfb' => $user_profile['id'],
					'nama' => $user_profile['name'],
					'link' => $user_profile['link'],
					'emailfb' => $user_profile['email'],
					'img' => 'https://graph.facebook.com/'. $user_profile['id'] .'/picture',
					'created'=> date('Y-m-d', NOW()),
					'n_status' => '0',
				 );
				 $res = $this->mymodel->insertdatafb('data_fb',$data);
				 echo "<pre>"; print_r($data);
				 
				 }catch(FacebookApiException $e){
				 
				 print_r($e);
				 
				 $user = null;
			 
			 }
		 }
	 
		 if($this->user){
		 
			 $logout = $this->facebook->getLogouturl(array("next"=>base_url()."login/logout"));
			 echo '<img src="https://graph.facebook.com/'. $user_profile['id'] .'/picture" width="30" height="30"/><br>';
			 echo "<a href='$logout'>Logout</a>";
		 
		 }else{
		 
			 $data['url'] = $login = $this->facebook->getLoginUrl(array("scope"=>"email"));
			 
			 $this->load->view('login', $data);
		 
		 }
	 
	 }
	 public function logout() {
	 
		 session_destroy();
		 
		 redirect(base_url().'login');
	 
	 }
}
?>