<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tess extends CI_Controller {
	
	 public function __construct()
        {
                parent::__construct();
                $this->load->model('mymodel');
				$this->load->library(array('Pagination','image_lib'));
				
        }
	function connect() {
	$host = '202.80.113.116';
	$db_name = 'db_lg';
	$db_user = 'root';
	$db_password = 'coppermine';
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
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
	$config['base_url'] = base_url().'page/galeri';
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
		$data['rowsiklan'] = $this->db->query('select *, MIN(harga) from iklan group by id asc LIMIT '.$id2.',4')->result();
		$data['rows']=$this->db->query('select * from content_management  order by id desc limit 0,8')->result();
		//$data['rowsiklan2'] = $this->db->query('select *, MIN(harga) from iklan group by id asc limit '.$id3.',4' )->result();
		//$data['rows4']=$this->db->query('select * from content_management  order by id desc limit '.$start2.',8')->result();
		//$data['rowsiklan3'] = $this->db->query('select * from iklan order by harga asc LIMIT '.$id4.',4')->result();
		$this->load->view('page/header');
		$this->load->view('tes',$data);
		$this->load->view('page/footer');
	}
	
	function pages(){
		$pdo = $this->connect();
		$lastidiklan = $_POST['lastidiklan'];
		$lastidcontent = $_POST['lastidcontent'];
		$limit = 8; // default value
		if (isset($_POST['limit'])) {
			$limit = intval($_POST['limit']);
		}
		$limitiklan = 4;
		$limitcontent = 8;
		//echo $limit;die;

		// select items for page params
		try {
			$sqliklan = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' group BY id LIMIT 0, '.$limitiklan.'';
			//echo $sqliklan;die;
			$sqlcontent = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			//echo $sql;die;
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
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lg.kanadigital.com/public/page/uploadcerita','http://lg.kanadigital.com/public/page/<?php echo $row['cerita']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
											if ($row['image']){
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['image']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lg.kanadigital.com/public/page/uploadcerita','http://lg.kanadigital.com/public/page/<?php echo $row['image']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
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
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lg.kanadigital.com/public/page/uploadcerita','http://lg.kanadigital.com/public/page/<?php echo $row['cerita']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
											if ($row['image']){
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row['image']."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lg.kanadigital.com/public/page/uploadcerita','http://lg.kanadigital.com/public/page/<?php echo $row['image']; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
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
	
	/* clear session */
	public function clearsession() {

		$this->session->sess_destroy();

		redirect('/page/twitter');
	}

		
}
?>