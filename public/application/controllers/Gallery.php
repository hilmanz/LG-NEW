<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	
	 public function __construct()
        {
                parent::__construct();
                $this->load->model('mymodel');
				$this->load->library('facebook'); // Automatically picks appId and secret from config
				$this->load->library(array('Pagination','image_lib'));
				
        }
	
	public function index(){
//echo "sss";die;		
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
	
	//echo $start; die;
	//$config['num_links'] = 20;
	
	$this->pagination->initialize($config);
		$data['halaman']=$this->pagination->create_links();
		$data['combo']=$this->mymodel->getCombo("jenis_produk");
		$data['banners'] = $this->db->query('select * from jenis_produk')->result();
		$data['baner'] = $this->db->query('select * from banner order by rand() limit 1')->result();
		$data['rowsiklan'] = $this->db->query('select *, MIN(harga) from iklan where n_status=1 group by id desc LIMIT '.$id2.',4')->result();
		$data['rows']=$this->db->query('select * from content_management where n_status=1 and data_stat=1 order by id desc limit '.$start.',8')->result();
		//$data['rowsiklan2'] = $this->db->query('select *, MIN(harga) from iklan group by id asc limit '.$id3.',4' )->result();
		//$data['rows4']=$this->db->query('select * from content_management  order by id desc limit '.$start2.',8')->result();
		//$data['rowsiklan3'] = $this->db->query('select * from iklan order by harga asc LIMIT '.$id4.',4')->result();
		$this->load->view('page/header');
		$this->load->view('gallery/gallery',$data);
		$this->load->view('page/footer');
	}
	
	function pages(){
		//echo base_url()."assets/vendor/custom.js"; die;
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
			
			$qiklan = 'select id, MAX(harga) from iklan where n_status=1 group by id desc limit 1';
			$qiklan1 = $pdo->prepare($qiklan);
			$qiklan1->execute();
			$qiklan2 = $qiklan1->fetchAll();
			foreach ($qiklan2 as $qiklan3){
				$ri = $qiklan3['id'];
			}
			
			$iklan = 'select id from iklan where n_status=1 order by id desc limit 1';
			$iklan1 = $pdo->prepare($iklan);
			$iklan1->execute();
			$iklan2 = $iklan1->fetchAll();
			foreach ($iklan2 as $iklan3){
				$iklan4 = $iklan3['id'];
			}
			
			$qcontent = 'SELECT id FROM content_management WHERE n_status=1 and data_stat=1 ORDER BY id asc LIMIT 1';
			$q = $pdo->prepare($qcontent);
			$q->execute();
			$qq = $q->fetchAll();
			foreach ($qq as $qqq){
				$re = $qqq['id'];
			}
			//echo $ri; die;
			
			if($ri==$lastidiklan && $re!=$lastidcontent){
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id <= '.$lastidiklan.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}else if($ri!=$lastidiklan && $re==$lastidcontent){
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$iklan4.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}else if($ri==$lastidiklan && $re==$lastidcontent){
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}else{
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id <= '.$lastidiklan.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}
			
			//echo $sql1; die;
			
			if($ri!=$lastidiklan && $re==$lastidcontent){
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}else if($ri==$lastidiklan && $re==$lastidcontent){
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}else if($ri!=$lastidiklan && $re!=$lastidcontent){
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}else{
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}
			
			//echo $sql2; die;
			$sqliklan = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			//echo $sqliklan; die;
			$sqlcontent = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			//echo $sqlcontent;die;
			$queryiklan = $pdo->prepare($sql1);
			$querycontent = $pdo->prepare($sql2);
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
		//require (base_url().'assets/vendor/custom.js');
		
		echo "<div class='adslist wow fadeInUp' data-wow-duration='0.5s' data-wow-delay='0.5s'>";
		foreach ($rowsiklan as $rowiklan){
			$lastidiklan = $rowiklan['id'];
			//$url = $rowiklan['url'];
						echo "<div class='items-product'>
								<div class='itemContainer'>
									<div class='entry'>
										<span class='productshop thumb'>
											
											<td><img alt='example2' src='".base_url()."iklan/".$rowiklan['iklan']."' border='0' width='200'></td>
										</span>
									</div>
									<div class='meta'>
										<div class='product-title'><span>".$rowiklan['nama']."</span></div>
										<div class='price'>";
										$harga = $rowiklan['harga'];
										$diskon1 = $rowiklan['hrg_diskon'];
										$diskon=number_format($diskon1,0,',','.');
										$rupiah=number_format($harga,0,',','.');
										echo "
											<span class='discount'>Rp ".$diskon."</span>
											<span>Rp ".$rupiah."</span>
										</div>	
										<div><a href='".$rowiklan['url']."' target='_blank'><img src='".base_url()."iklan/".$rowiklan['logo_toko']."'></a></div>
									</div>
								</div>
							</div>";
					}
					echo "</div>";
				?>
				<!-- End Iklan pertama -->
				
				
                    <?php 
						$i=1;
						echo "<div class='galleryLists wow fadeInUp' data-wow-duration='0.5s' data-wow-delay='0.5s'>";
						foreach ($rows as $row) {
						$lastidcontent = $row['id'];							
							if ($row['type_sosmed']=='twitter'){ ?>
                 				<div class="items <?php if($row['type_campaign']=='cerita'){ ?> items-text  <?php  }    ?>">
								<div class="itemContainer">
									<i class="ico icon-twitter"></i>
									<div class="entry">
										<!--<span class="photo-entry-text thumb">-->
											<?php 
											
											if($row['type_campaign']=='cerita'){
												echo "<span class='photo-entry-text thumb'>";
												echo $row['cerita'];
												echo "</span>";
											}else{
												echo "<a href='#id-".$row['id']."' class='photo-entry thumb showPopup'>";
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
												echo "</a>";
											}											
											?>
											<div class="popup">
			                                    <div id="id-<?php echo $row['id']; ?>" class="popupContainer">
			                                       <img src='<?php echo base_url(); ?>page/<?php echo $row['image']; ?>' border='0'>
			                                    </div>
			                                </div>
										<!--</span>-->
									</div>
									<div class="meta">
										<div class="thumb thumb-small"><?php echo "<img src='".$row['gambar_akun']."'/>" ?></div>
										<div class="userdetail">
											<span class="userID"><?php echo $row['nama_akun']; ?></span>
										</div>
									</div>
									<div class="sharebox">
										<div class="sharebox-entry">
											<h3>SHARE</h3>
										   <?php
												$cerita="Bagi cerita pengalaman pertama Anda bersama LG di www.LGForYou.com dan menangkan berjuta hadiah menariknya! &hashtags=LGForYou";
												$image="Produk LG ini siap untuk mengisi ruang kosong dalam rumah Anda. Ikuti kontes foto di  www.LGForYou.com dan dapatkan kejutan hadiah dari LG! &hashtags=LGForYou";
											
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/public/page/uploadcerita','http://lgindonesia.com/lgforyou/public/page/<?php echo $row['image']; ?>','','<?php echo $image; ?>')"><i class="icon-facebook">&nbsp;</i></a>
										  
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
							<?php }
					
							else{ ?>
                 				<div class="items <?php if($row['type_campaign']=='cerita'){ ?> items-text  <?php  }    ?>">
								<div class="itemContainer">
									<i class="ico icon-facebook"></i>
									<div class="entry">
										<!--<span class="photo-entry-text thumb">-->
											<?php 
											if($row['type_campaign']=='cerita'){
												echo "<span class='photo-entry-text thumb'>";
												echo $row['cerita'];
												echo "</span>";
											}else{
												echo "<a href='#id-".$row['id']."' class='photo-entry thumb showPopup'>";
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
												echo "</a>";
											}							
											?>
											<div class="popup">
			                                    <div id="id-<?php echo $row['id']; ?>" class="popupContainer">
			                                       <img src='<?php echo base_url(); ?>page/<?php echo $row['image']; ?>' border='0'>
			                                    </div>
			                                </div>
										<!--</span>-->
									</div>
									<div class="meta">
											<div class="thumb thumb-small"><?php echo "<img src='".$row['gambar_akun']."'/>" ?></div>
											<div class="userdetail">
												<span class="userID"><?php echo $row['nama_akun']; ?></span>
											</div>
									</div>
									<div class="sharebox">
										<div class="sharebox-entry">
											<h3>SHARE</h3>
											<?php
												$cerita="Bagi cerita pengalaman pertama Anda bersama LG di www.LGForYou.com dan menangkan berjuta hadiah menariknya! &hashtags=LGForYou";
												$image="Produk LG ini siap untuk mengisi ruang kosong dalam rumah Anda. Ikuti kontes foto di  www.LGForYou.com dan dapatkan kejutan hadiah dari LG! &hashtags=LGForYou";
											
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/public/page/uploadcerita','http://lgindonesia.com/lgforyou/public/page/<?php echo $row['image']; ?>','','<?php echo $image; ?>')"><i class="icon-facebook">&nbsp;</i></a>
										
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
					 
							<?php } 
						$i++;
						}
							echo "</div>";

		if ($lastidiklan != 0 && $lastidcontent !=0) {
			echo '<script type="text/javascript">var lastidiklan = '.$lastidiklan.';
			var lastidcontent = '.$lastidcontent.'</script>';
		}

		// sleep for 1 second to see loader, it must be deleted in prodection
		sleep(1);

	}
	
	public function filter($ids){	
			
		$where="where jns_produk=".$ids;		
		
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

		$start = 0;
		$start2=8;
		if($start=='')$start=0;
	
		//echo $ids; die;
		//$config['num_links'] = 20;
		
		$data['halaman']=$this->pagination->create_links();
		$data['combo']=$this->mymodel->getCombo("jenis_produk");
		$data['banners'] = $this->db->query('select * from jenis_produk')->result();
		$data['baner'] = $this->db->query('select * from banner where id_produk='.$ids.'')->result();
		$data['rowsiklan'] = $this->db->query('select *, MIN(harga) from iklan '.$where.' and n_status=1 group by id asc LIMIT '.$id2.',4')->result();
		$data['rows']=$this->db->query('select * from content_management '.$where.' and n_status=1 and data_stat=1 order by id desc limit '.$start.',8')->result();
		//$data['rowsiklan2'] = $this->db->query('select *, MIN(harga) from iklan '.$where.' group by id asc limit '.$id3.',4' )->result();
		//$data['rows4']=$this->db->query('select * from content_management '.$where.'  order by id desc limit '.$start2.',8')->result();
		//$data['rowsiklan3'] = $this->db->query('select * from iklan order by harga asc LIMIT '.$id4.',4')->result();
		//echo $data['rows']; die;
		
		$this->load->view('page/header');
		$this->load->view('gallery/galery',$data);
		$this->load->view('page/footer');
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
			
			$qiklan = 'select id, MAX(harga) from iklan where n_status=1 and jns_produk='.$jenis.' group by id desc limit 1';
			//$sql = 'select id from iklan where jns_produk='.$jenis.' group by id desc limit 1';
			$qiklan1 = $pdo->prepare($qiklan);
			$qiklan1->execute();
			$qiklan2 = $qiklan1->fetchAll();
			foreach ($qiklan2 as $qiklan3){
				$ri = $qiklan3['id'];
			}
			
			$iklan = 'select id from iklan where n_status=1 and jns_produk='.$jenis.' order by id desc limit 1';
			$iklan1 = $pdo->prepare($iklan);
			$iklan1->execute();
			$iklan2 = $iklan1->fetchAll();
			foreach ($iklan2 as $iklan3){
				$iklan4 = $iklan3['id'];
			}
			
			$qcontent = 'SELECT id FROM content_management WHERE jns_produk='.$jenis.' and n_status=1 and data_stat=1 ORDER BY id asc LIMIT 1';
			$q = $pdo->prepare($qcontent);
			$q->execute();
			$qq = $q->fetchAll();
			foreach ($qq as $qqq){
				$re = $qqq['id'];
			}
			//echo $ri; die;
			
			if($ri==$lastidiklan && $re!=$lastidcontent){
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id <= '.$lastidiklan.' and jns_produk='.$jenis.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}else if($ri!=$lastidiklan && $re==$lastidcontent){
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$iklan4.' and jns_produk='.$jenis.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}else if($ri==$lastidiklan && $re==$lastidcontent){
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' and jns_produk='.$jenis.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}else{
				$sql1 = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' and jns_produk='.$jenis.' and n_status=1 group by id LIMIT 0, '.$limitiklan.'';
			}
			
			//echo $sql1; die;
			
			if($ri!=$lastidiklan && $re==$lastidcontent){
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and jns_produk='.$jenis.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}else if($ri==$lastidiklan && $re==$lastidcontent){
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and jns_produk='.$jenis.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}else if($ri!=$lastidiklan && $re!=$lastidcontent){
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and jns_produk='.$jenis.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}else{
				$sql2 = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and jns_produk='.$jenis.' and n_status=1 and data_stat=1 ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			}
			 //echo $sql1; die;
			
			/* $sql = 'select id from iklan where jns_produk='.$jenis.' group by id desc limit 1';
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
			} */
			$sqliklan = 'SELECT *, MIN(harga) FROM iklan WHERE id > '.$lastidiklan.' and jns_produk='.$jenis.' group by id LIMIT 0, '.$limitiklan.'';
			$sqlcontent = 'SELECT * FROM content_management WHERE id < '.$lastidcontent.' and jns_produk='.$jenis.' ORDER BY id desc LIMIT 0, '.$limitcontent.'';
			//echo $sql2; die;
			//echo $sqlcontent;die;
			$queryiklan = $pdo->prepare($sql1);
			$querycontent = $pdo->prepare($sql2);
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
										<div class='price'>";
										$harga = $rowiklan['harga'];
										$diskon1 = $rowiklan['hrg_diskon'];
										$diskon=number_format($diskon1,0,',','.');
										$rupiah=number_format($harga,0,',','.');
										echo "
											<span class='discount'>Rp ".$diskon."</span>
											<span>Rp ".$rupiah."</span>
										</div>
										<div><a href='".$rowiklan['url']."' target='_blank'><img src='".base_url()."iklan/".$rowiklan['logo_toko']."'></a></div>
									</div>
								</div>
							</div>
						</div>";
					}
				?>
				<!-- End Iklan pertama -->
				
				
                    <?php 
						$i=1;
						foreach ($rows as $row) {
						$lastidcontent = $row['id'];							
						echo "<div class='galleryLists'>";
							if ($row['type_sosmed']=='twitter'){ ?>
							 <div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-twitter"></i>
									<div class="entry">
										<!--<span class="photo-entry-text thumb">-->
											<?php 
											if($row['type_campaign']=='cerita'){
												echo "<span class='photo-entry-text thumb'>";
												echo $row['cerita'];
												echo "</span>";
											}else{
												echo "<a href='#id-".$row['id']."' class='photo-entry thumb showPopup'>";
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
												echo "</span>";
											}								
											?>
											<div class="popup">
			                                    <div id="id-<?php echo $row['id']; ?>" class="popupContainer">
			                                       <img src='<?php echo base_url(); ?>page/<?php echo $row['image']; ?>' border='0'>
			                                    </div>
			                                </div>
										<!--</span>-->
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
											$cerita="Bagi cerita pengalaman pertama Anda bersama LG di www.LGForYou.com dan menangkan berjuta hadiah menariknya! &hashtags=LGForYou";
											$image="Produk LG ini siap untuk mengisi ruang kosong dalam rumah Anda. Ikuti kontes foto di  www.LGForYou.com dan dapatkan kejutan hadiah dari LG! &hashtags=LGForYou";
											
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/public/page/uploadcerita','http://lgindonesia.com/lgforyou/public/page/<?php echo $row['image']; ?>','','<?php echo $image; ?>')"><i class="icon-facebook">&nbsp;</i></a>										   
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
										<!--<span class="photo-entry-text thumb">-->
											<?php 
											if($row['type_campaign']=='cerita'){
												echo "<span class='photo-entry-text thumb'>";
												echo $row['cerita'];
												echo "</span>";
											}else{
												echo "<a href='#id-".$row['id']."' class='photo-entry thumb showPopup'>";
												echo "<img src='".base_url()."page/".$row['image']."' border='0' width='160'>"; 
												echo "</a>";
											}								
											?>
											<div class="popup">
			                                    <div id="id-<?php echo $row['id']; ?>" class="popupContainer">
			                                       <img src='<?php echo base_url(); ?>page/<?php echo $row['image']; ?>' border='0'>
			                                    </div>
			                                </div>
										<!--</span>-->
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
											$cerita="Bagi cerita pengalaman pertama Anda bersama LG di www.LGForYou.com dan menangkan berjuta hadiah menariknya! &hashtags=LGForYou";
											$image="Produk LG ini siap untuk mengisi ruang kosong dalam rumah Anda. Ikuti kontes foto di  www.LGForYou.com dan dapatkan kejutan hadiah dari LG! &hashtags=LGForYou";
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/public/page/uploadcerita','http://lgindonesia.com/lgforyou/public/page/<?php echo $row['image']; ?>','','<?php echo $image; ?>')"><i class="icon-facebook">&nbsp;</i></a>
										   
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
					 
							<?php } 
							echo "</div>";
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
		$host = 'localhost';		$db_name = 'lgindone_lgforyou';		$db_user = 'lgindone_lgforyo';		$db_password = '123lgforyou123';		return new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
}
?>