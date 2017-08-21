<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu2 extends CI_Controller {
	public function index()
	{
		$this->load->view('menu2');
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
		echo $email;
	
		
		$where = array(
			'email' => 'fauzi.rahman@kana.co.id'
		);
		$data_update = array(
			'n_status' => 1,			
		);
		//print_r($data_update);
		//pr($data_update);die;
		$res = $this->mymodel->UpdateData('content_management',$data_update,$where);
		echo $res;
		/* if($res>=1){
			redirect('menu2/submenu');			
		}else{
			echo "GAGAL!!!";
		} */
	}
	
	
	public function do_upload(){
		
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules("nama", "Full Name is", "required");
		$this->form_validation->set_rules("notelp", "No Telpon", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		
		
		if($this->form_validation->run() == FALSE){
			$this->load->model('mymodel');			
			$data['images'] = $this->mymodel->get_images();
			$data['imagess'] = $this->mymodel->get_last_images();
			$this->load->view('submenu2', $data);
		}
		
		else{
			
			
			$this->load->view('submenu2');
			
		
			$acak=rand(00000000000,99999999999);
			$bersih=$_FILES['userfiles']['name'];
			$nm=str_replace(" ","_","$bersih");
			$pisah=explode(".",$nm);
			$nama_murni=$pisah[0];
			$ubah=$acak.$nama_murni; //tanpa ekstensi
			$config['image_library'] = 'gd2';
			
			$gambar=$_FILES['userfiles']['name'];;	
			$config['file_name']=$_FILES['userfiles']['name'];;		
			$config['upload_path'] = "upload/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']    = '30000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$nama = $_POST['nama'];
			$telp = $_POST['notelp'];
			$email = $_POST['email'];
			$link= strtr(base64_encode($email), '+/=', '-_,');
			//$link= urlencode(base64_encode($email));
			$link2 = base_url()."menu2/status/".$link;
			
			$template =' <div style=" background:#730000; color:#fff; padding:40px 30px; font-family:sans-serif; line-height: 24px;">
                        <p>Hai, </p>
                        <p>Anda diundang untuk bergabung dengan <strong style="color:#fdcb02;">LG Digital</strong>.<br><a style="color:#fdcb02; text-decoration:none;" target="blank
                        " href="<? echo $link2;?>">Klik disini</a> untuk bergabung.<br>
                        Jika anda tidak bisa klik link di atas, copy link di bawah ini ke browser<br><span style="color:#fdcb02;">!#link</span></p>
                        
                        </div>';
			$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';
				
			$template .= base_url()."menu2/status/".$link;
			
			
			echo $link;
		
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
	 
			if(!$this->upload->do_upload('userfiles')){			
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
			

							
				$data = array(
						 'nama' => $nama,
						 'notelp' => $telp,
						 'email' => $email,
						 'type_campaign' => 'gambar',
						 'image' => $gambar,
						 'created'=> date('Y-m-d', NOW())
					);
				$res = $this->mymodel->upload_foto('content_management',$data);
							
					//print_r($res);
				//echo $res;
				if($res==1){
					echo '<script>alert("You Have Successfully Insert this Record!");</script>';
					redirect('menu2/submenu','refresh');
					//echo $config['upload_path'];
				}else{
					echo "GAGAL!";
				}
			}
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
	$data['rows2'] = $this->db->query('select iklan from iklan limit '.$id2.',4 ')->result();
	$data['rows3'] = $this->db->query('select iklan from iklan LIMIT '.$id3.',4')->result();
	
	$this->load->view('galeri', $data);
	}
	
	public function sendemail(){
		/* $ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
					  'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
							array('from' => 'LG<sscr-admin@LGDigital.co.id>',
								  'to' => 'fauzi.rahman@kana.co.id',
								  'subject' => 'Registrasi Member ',
								  'html' => 'Anda Telah terdaftar sebagai Member LG',
								  'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			// pr($info);
			// pr($result);
			$res = json_decode($result,TRUE); */
			$link=urlencode('fauzi.rahman@kana.co.id');
			$template ='Aktivasi sebagai Member LG. Klik link dibawah ini ';
	$template .= base_url()."menu2/Contentmanagement".$link;
	echo $template;
	}
}
?>