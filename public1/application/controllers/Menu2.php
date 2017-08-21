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
	
	public function do_upload(){
		
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules("nama", "Full Name", "required");
		$this->form_validation->set_rules("notelp", "No Telpon", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		
		
		if($this->form_validation->run() == FALSE){
			$this->load->model('mymodel');			
			$data['images'] = $this->mymodel->get_images();
			$data['imagess'] = $this->mymodel->get_last_images();
			$this->load->view('submenu2', $data);
		}
		
		else{
			
			$this->load->library("email"); 
			$this->email->set_newline("\r\n");
			
			$this->email->from(set_value("email"), set_value("nama"));
			$this->email->to("vkar93@yahoo.co.id");
			$this->email->subject("Thanks to your attention");
			$this->email->message("your foto submitted");
			if($this->email->send()){
				$data['msg'] = "email sent!";
			}else{
				show_error($this->email->print_debugger());
			}
			$this->load->view('submenu2');
			
		
			$acak=rand(00000000000,99999999999);
			$bersih=$_FILES['userfiles']['name'];
			$nm=str_replace(" ","_","$bersih");
			$pisah=explode(".",$nm);
			$nama_murni=$pisah[0];
			$ubah=$acak.$nama_murni; //tanpa ekstensi
			
			$gambar=$_FILES['userfiles']['name'];;	
			$config['file_name']=$_FILES['userfiles']['name'];;		
			$config['upload_path'] = "upload/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']    = '30000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			//$this->load->library('upload', $config);
			
			$this->upload->initialize($config);		
			
				
			
					
				
	 
			if(!$this->upload->do_upload('userfiles')){			
				echo $this->upload->display_errors();
				echo 'gagal'. $config['upload_path'];		
			}
			else{
				$data = array('upload_data' => $this->upload->data());	   
				$nama = $_POST['nama'];
				$telp = $_POST['notelp'];
				$email = $_POST['email'];
				
			$resize['new_image'] = "upload/thumb/";			
			$resize['width']  = '140';
			$resize['height']  = '125';
			$this->load->library('image_lib', $resize);

			$this->image_lib->resize();

							
				$data = array(
						 'nama' => $nama,
						 'notelp' => $telp,
						 'email' => $email,
						 'type_campaign' => 'gambar',
						 'thumb' => $thumb,
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
}
?>