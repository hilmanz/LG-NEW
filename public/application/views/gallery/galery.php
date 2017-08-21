<div id="gallery-page" class="theContainer">
    <div class="container">
        <div class="row">		
            <div  class="col-md-12">
                <div class="entry center  w700">
                    <h1 class="red  normal">Gallery</h1>
                    <p>Ini adalah sahabat-sahabat LG yang sudah berbagi cerita dengan kami. Anda juga dapat berbagi cerita dan kesan pesan mengenai LG di sini. Karena selalu ada cerita di balik pengalaman Anda dan LG.</p>
					<form id="sortGallery" class="theForm">
                        <?php //echo form_dropdown('id', $jenis_produk, set_value('id', $jenis_produk),'onChange="windows.location=http://lg.kanadigital/page/galery/1"'); ?>
						<div>
							<div class="customselect">
								<select onchange="top.location.href = '<?= base_url() ?>gallery/filter/'+ this.options[ this.selectedIndex ].value" >
									<option value=''>Sort By :</option>
									<?php
										if (count($combo)) {
											foreach ($combo as $key => $list) {
												if ($list['id']==$id){		
													echo "<option value='". $list['id'] . "' selected>" . $list['nama'] . "</option>";		
												}
												echo "<option value='". $list['id'] . "'>" . $list['nama'] . "</option>";
											}		
										}	
									?>
								</select>
							</div>
						</div>
					</form>
                </div>
				<!-- Start Banner -->
                <div class="ads">
					<?php
					foreach ($baner as $banner){
						echo"
                    <a href='".$banner->url."'><img src='".base_url()."image/banner/".$banner->banner."'/></a>";}?>
                </div>
				<!-- End Banner -->
				<div id="items">
				<!-- Start Iklan pertama -->
				<?	
					$lastidiklan = 0;
					foreach ($rowsiklan as $rowiklan){
						$jenis = $rowiklan->jns_produk;
						$lastidiklan = $rowiklan->id;
						echo "<div id='tess' class='productList'>
							<div class='items-product'>
								<div class='itemContainer'>
									<div class='entry'>
										<span class='productshop thumb'>
											
											<td><img alt='example2' src='".base_url()."iklan/".$rowiklan->iklan."' border='0' width='200'></td>
										</span>
									</div>
									<div class='meta'>
										<div class='product-title'><span>".$rowiklan->nama."</span></div>
										<div class='price'>";
										$harga = $rowiklan->harga;
										$diskon1 = $rowiklan->hrg_diskon;
										$diskon=number_format($diskon1,0,',','.');
										$rupiah=number_format($harga,0,',','.');
										echo "
											<span class='discount'>".$diskon."</span>
											<span>".$rupiah."</span>
										</div>
										<div><a href='".$rowiklan->url."' target='_blank'><img src='".base_url()."iklan/".$rowiklan->logo_toko."'></a></div>
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
	
				<?
				// sleep for 1 second to see loader, it must be deleted in prodection
				sleep(1);
				
				// Start Content Pertama
				?>
                <div class="galleryLists">
                    <?php 
						$i=1;
						$lastidcontent = 0;
						foreach ($rows as $row) {
							$lastidcontent = $row->id;
							if ($row->type_sosmed=='twitter'){ ?>
							 <div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-twitter"></i>
									<div class="entry">
										<!--<span class="photo-entry-text thumb">-->
											<?php 
											if($row->type_campaign=='cerita'){
												echo "<span class='photo-entry-text thumb'>";
												echo $row->cerita;
												echo "</span>";
											}else{
												echo "<a href='#id-".$row->id."' class='photo-entry thumb showPopup'>";
												echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
												echo "</a>";
											}									
											?>
											<div class="popup">
			                                    <div id="id-<?php echo $row->id; ?>" class="popupContainer">
			                                       <img src='<?php echo base_url(); ?>page/<?php echo $row->image; ?>' border='0'>
			                                    </div>
			                                </div>
										<!--</span>-->
									</div>
									<div class="meta">
										<div class="thumb thumb-small"><?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
										<div class="userdetail">
											<!--<span class="username"><?php echo $row->id_akun; ?></span>-->
											<span class="userID"><b><?php echo $row->nama_akun; ?></b></span>
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
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/public/page/uploadcerita','http://lgindonesia.com/lgforyou/public/page/<?php echo $row->image; ?>','','<?php echo $image; ?>')"><i class="icon-facebook">&nbsp;</i></a>
										   
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
											if($row->type_campaign=='cerita'){
												echo "<span class='photo-entry-text thumb'>";
												echo $row->cerita;
												echo "</span>";
											}else{
												echo "<a href='#id-".$row->id."' class='photo-entry thumb showPopup'>";
												echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
												echo "</a>";
											}									
											?>
											<div class="popup">
			                                    <div id="id-<?php echo $row->id; ?>" class="popupContainer">
			                                       <img src='<?php echo base_url(); ?>page/<?php echo $row->image; ?>' border='0'>
			                                    </div>
			                                </div>
										<!--</span>-->
									</div>
									<div class="meta">
										<div class="thumb thumb-small"><?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
										<div class="userdetail">
											<!--<span class="username"><?php echo $row->id_akun; ?></span>-->
											<span class="userID"><b><?php echo $row->nama_akun; ?></b></span>
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
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/public/page/uploadcerita','http://lgindonesia.com/lgforyou/public/page/<?php echo $row->image; ?>','','<?php echo $image; ?>')"><i class="icon-facebook">&nbsp;</i></a>										   
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
					 
							<?php } 
						$i++;
						} 
					?>
				</div>
				<script type="text/javascript">var lastidiklan = <?php echo $lastidiklan; ?>; 
					var lastidcontent = <?php echo $lastidcontent; ?>;
					var jenis = <?php echo $jenis; ?>;
				</script>
            </div><!-- end .col-md-12 -->
				<div style="clear:both; text-align:center;"><p id="loader"><img src="<?= base_url()?>image/ajax-loader.gif"></p></div>
				<?php
				if ($lastidiklan != 0 && $lastidcontent !=0) {
					echo '<script type="text/javascript">var lastidiklan = '.$lastidiklan.'; 
						var lastidcontent = '.$lastidcontent.';
						var jenis = '.$jenis.';
						</script>';
				}
				
				// sleep for 1 second to see loader, it must be deleted in prodection
					sleep(1);
				?>
            </div><!-- end .col-md-12 -->			
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #term-page -->
<script type="text/javascript" src="<?= base_url()?>assets/js/jquery.endless-scroll.js"></script>
<script type="text/javascript">
var basedomain = 'http://lgindonesia.com/lgforyou/public/';
var is_loading = false; // initialize is_loading by false to accept new loading
var limitiklan = 4; // limit items per page
var limitcontent = 8; // limit items per page
$(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            if (is_loading == false) { // stop loading many times for the same page
                // set is_loading to true to refuse new loading
                is_loading = true;
                // display the waiting loader
                $('#loader').show();
				//console.log('sss');
                // execute an ajax query to load more statments
                //alert('sss');
				$.ajax({
					//console.log('ss');
                    url: basedomain+'gallery/pagesnew',
                    type: 'POST',
                    data: {jenis:jenis, lastidiklan:lastidiklan, lastidcontent:lastidcontent, limitiklan:limitiklan, limitcontent:limitcontent},
                    success:function(data){
						/*    //console.log('ss');
                        // now we have the response, so hide the loader
                        $('#loader').hide();
                        // append: add the new statments to the existing data
                        $('#items').append(data);
                        // set is_loading to false to accept new loading
                        is_loading = false;  */ 
						 
						  if(data){
							$('#items').append(data);
							$('#loader').hide();
						}else{
							
							$('#loader').data('<center>No more posts to show.</center>');							
							
						} 
$('.showPopup').magnificPopup({
	  type: 'inline',

	  fixedContentPos: false,
	  fixedBgPos: true,

	  overflowY: 'auto',

	  closeBtnInside: true,
	  preloader: false,
	  
	  midClick: true,
	  removalDelay: 300,
	  mainClass: 'my-mfp-zoom-in'
	});						
                    }
                });
            }
       }
    });
});
function owlCarousel() {
	    $(".adslist").owlCarousel({
			items : 4,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [980,3],
			itemsTablet: [768,2],
			itemsTabletSmall: false,
			itemsMobile : [479,1],
			margin: 210,
	 
		    // Navigation
		    navigation : true,
		    navigationText : ["",""],
		    rewindNav : true,
		    scrollPerPage : false,
		 
		    //Pagination
		    pagination : false,
		    paginationNumbers: false,
	    });
}
$('.showPopup').magnificPopup({
	  type: 'inline',

	  fixedContentPos: false,
	  fixedBgPos: true,

	  overflowY: 'auto',

	  closeBtnInside: true,
	  preloader: false,
	  
	  midClick: true,
	  removalDelay: 300,
	  mainClass: 'my-mfp-zoom-in'
	});
</script>