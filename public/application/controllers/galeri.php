<div id="gallery-page" class="theContainer">
    <div class="container">
        <div class="row">
		
            <div  class="col-md-12">
                <div class="entry center  w700">
                    <h1 class="red  normal">Gallery</h1>
                    <p>Ini adalah sahabat-sahabat LG yang sudah berbagi cerita dengan kami. Anda juga dapat berbagi cerita dan kesan pesan mengenai LG di sini. Karena selalu ada cerita di balik pengalaman Anda dan LG.</p>
                   <form id="sortGallery" class="theForm">
                        <input type="text" placeholder="Sort by :">
                   </form>
                </div>
                <div class="ads">
                    <a href="#"><img src="<?= base_url()?>assets/content/ads3.jpg"/></a>
                </div>
	 <section id="recentgallery">
        <div class="container">
            <div id="galleryList" class="owl-carousel">
                <?php foreach ($banners as $banner) { ?>
				 <div class="items items-text">
                    <div class="itemContainer">
                        
                        <div id="menux" class="entry">
                            <span class="photo-entry-text thumb">
                                <?php 
							
								echo "<a id='btnprod' href='javascript:void(0)'><input type='hidden' name='id_prod' id='id_prod' value='".$banner->nama."'><img id='imglink' src='".base_url()."produk/".$banner->banner."' border='0' width='160'></a>"; 
								//echo "<a id='btnprod' href='".base_url()."page/galeri/".$banner->id."'><input type='hidden' name='id_prod' id='id_prod[]' value='".$banner->id."'><img src='".base_url()."produk/".$banner->banner."' border='0' width='160'></a>"; 								
								?>
                            </span>
                        </div>
                        <div class="meta">
                                <div class="thumb thumb-small"></div>
                                <div class="userdetail">
                                    <span class="username"><?php echo $banner->nama; ?></span>
                                    <span class="userID"><?php echo $banner->keterangan; ?></span>
                                </div>
                        </div>
                        
                    </div><!-- end .itemContainer -->
                </div><!-- end .items -->			
				
				<?php } ?>
            </div><!-- end #galleryList -->
        </div>
    </section>
				
				
                <div class="galleryLists">
                    <?php 
					$i=1;
					foreach ($rows as $row) { if ($row->type_sosmed=='twitter'){ ?>
				 <div class="items items-text">
                    <div class="itemContainer">
                        <i class="ico icon-twitter"></i>
                        <div class="entry">
                            <span class="photo-entry-text thumb">
                                <?php 
								if ($row->cerita){
								echo "<img src='".base_url()."page/".$row->cerita."' border='0' width='160'>"; 
								}else{
									echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
								}								
								?>
                            </span>
                        </div>
                        <div class="meta">
                                <div class="thumb thumb-small"><?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
                                <div class="userdetail">
                                    <span class="username"><?php echo $row->id_akun; ?></span>
                                    <span class="userID"><?php echo $row->nama_akun; ?></span>
                                </div>
                        </div>
                        <div class="sharebox">
                            <div class="sharebox-entry">
                                <h3>SHARE</h3>
                                <a href="#" class="sharebtn"><i class="icon-twitter"></i></a>
                                <a href="#" class="sharebtn"><i class="icon-facebook"></i></a>
                            </div>
                        </div>
                    </div><!-- end .itemContainer -->
                </div><!-- end .items -->
				<?php }else{ ?>
				<div class="items items-text">
                    <div class="itemContainer">
                        <i class="ico icon-facebook"></i>
                        <div class="entry">
                            <span class="photo-entry-text thumb">
                                <?php 
								if ($row->cerita){
								echo "<img src='".base_url()."page/".$row->cerita."' border='0' width='160'>"; 
								}else{
									echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
								}								
								?>
                            </span>
                        </div>
                        <div class="meta">
                                <div class="thumb thumb-small"><?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
                                <div class="userdetail">
                                    <span class="username"><?php echo $row->id_akun; ?></span>
                                    <span class="userID"><?php echo $row->nama_akun; ?></span>
                                </div>
                        </div>
                        <div class="sharebox">
                            <div class="sharebox-entry">
                                <h3>SHARE</h3>
                                <a href="#" class="sharebtn"><i class="icon-twitter"></i></a>
                                <a href="#" class="sharebtn"><i class="icon-facebook"></i></a>
                            </div>
                        </div>
                    </div><!-- end .itemContainer -->
                </div><!-- end .items -->
				 
				<?php } 
				if($i=='8'){
				foreach ($rows2 as $row2) 
				{
				echo "<div class='productList'>
                    <div class='items-product'>
                        <div class='itemContainer'>
                            <div class='entry'>
                                <span class='productshop thumb'>";
				echo "<td><img alt='example2' src='".base_url()."assets/content/shop/".$row2->iklan."' border='0' width='200'></td>";
				echo " </span>
                            </div>
                            <div class='meta'>
                                <div class='product-title'><span>LG - 24 LED TV 24LF450A</span></div>
                                <div class='price'>
                                    <span class='discount'>Rp. 2.049.000</span>
                                    <span>Rp. 1.999.000</span>
                                </div>
                                <div class='seller'>
                                    <img src='".base_url()."assets/content/hartono.jpg'/>
                                </div>
                            </div>
                        </div>
                    </div>";
				}
					
				
				
				
				}
				$i++;} ?>
                 </div><!-- end #galleryList --> 
					<?php
					
				foreach ($rows3 as $row3) 
				{
				echo "<div class='productList'>
                    <div class='items-product'>
                        <div class='itemContainer'>
                            <div class='entry'>
                                <span class='productshop thumb'>";
				echo "<td><img alt='example2' src='".base_url()."assets/content/shop/".$row3->iklan."' border='0' width='200'></td>";
				echo " </span>
                            </div>
                            <div class='meta'>
                                <div class='product-title'><span>LG - 24 LED TV 24LF450A</span></div>
                                <div class='price'>
                                    <span class='discount'>Rp. 2.049.000</span>
                                    <span>Rp. 1.999.000</span>
                                </div>
                                <div class='seller'>
                                    <img src='".base_url()."assets/content/hartono.jpg'/>
                                </div>
                            </div>
                        </div>
                    </div>";
				
				}
					?>
                <div id="pagination"><center><font size="5">Paging-- <?php echo $halaman;?> --</font></center><div>
                
            </div><!-- end .col-md-12 -->
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #term-page -->

<div id="container">
		Isi dari file content.php akan ditampilkan di sini
	</div>

<script type="text/javascript">
   	
	$(document).ready(function(){
	$("#imglink").click(function(e){
		var id = $("#id_prod").val();       
        //var id=$("#id_prod").attr('value');
		e.preventDefault();
		
         $.ajax({
                type:"POST",
                url: "<?= base_url() ?>page/galeri",
                data: "id="+id,
                beforeSend: function(){
                $("#loading-box").show();
            },
            success: function(pesan){ 
                 resetForm($('#formcerita')); 
            } 
        });   
		
	});
	});
	
		
</script>
