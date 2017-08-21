<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menupertama extends CI_Controller {
	public function index()
	{
		$this->load->view('menu1');
	}
	
	/* public function submenu()
	{
		$data = array(
			"contents" => $this->mymodel->GetKonten()->result_array()
		);
		$this->load->view('submenu1',$data);
	} */
	
	public function submenu()
	{
		//load model
		$this->load->model('mymodel');
		
		//get data from the database
		$data['images'] = $this->mymodel->get_images();
		
		//load view and pass the data
		$this->load->view('submenu1', $data);
		$this->load->view('slide', $data);
	}
	
	function insert(){
		$nama = $_POST['nama'];
		$no_telp = $_POST['no_telp'];
		$email = $_POST['email'];
		$jenis = $_POST['jns_produk'];
		$cerita = $_POST['cerita'];
		//$created = 'now()';
		$data = array(
			'nama' => $nama,
			'no_telp' => $no_telp,
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
			echo '<script>alert("You Have Successfully Insert this Record!");</script>';
			redirect('','refresh');
		}else{
			echo "GAGAL!";
		}
	}
}
