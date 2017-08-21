<div id="gallery-page" class="theContainer">
    <div class="container">
        <div class="row">		
            <div  class="col-md-12">
                <div class="entry center  w700">
                    <h1 class="red  normal">Gallery</h1>
                    <p>Ini adalah sahabat-sahabat LG yang sudah berbagi cerita dengan kami. Anda juga dapat berbagi cerita dan kesan pesan mengenai LG di sini. Karena selalu ada cerita di balik pengalaman Anda dan LG.</p>
					<form id="sortGallery" class="theForm">
                        <?php //echo form_dropdown('id', $jenis_produk, set_value('id', $jenis_produk),'onChange="windows.location=http://lgindonesia.com/lgforyou/page/galery/1"'); ?>
						<div>
							<div class="customselect">
								<select onchange="top.location.href = '<?= base_url() ?>page/galeriy/'+ this.options[ this.selectedIndex ].value" >
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
                    <a href='#'><img src='".base_url()."image/banner/".$banner->image."'/></a>";}?>
                </div>
				<!-- End Banner -->
				<div id="items">
				<!-- Start Iklan pertama -->
				<?	
					$lastidiklan = 0;
					foreach ($rowsiklan as $rowiklan){						
						$lastidiklan = $rowiklan->id;
						echo "<div class='productList'>
							<div class='items-product'>
								<div class='itemContainer'>
									<div class='entry'>
										<span class='productshop thumb'>
											
											<td><img alt='example2' src='".base_url()."iklan/".$rowiklan->iklan."' border='0' width='200'></td>
										</span>
									</div>
									<div class='meta'>
										<div class='product-title'><span>".$rowiklan->nama."</span></div>
										<div class='price'>
											<span class='discount'>".$rowiklan->hrg_diskon."</span>
											<span>".$rowiklan->harga."</span>
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
	
				<?
				// sleep for 1 second to see loader, it must be deleted in prodection
				sleep(1);
				
				// Start Content Pertama
				?>
                    <?php 
						$i=1;
						$lastidcontent = 0;
						foreach ($rows as $row) {
							$lastidcontent = $row->id;
                echo "<div class='galleryLists'>";
							if ($row->type_sosmed=='twitter'){ ?>
							 <div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-twitter"></i>
									<div class="entry">
										<span class="photo-entry-text thumb">
											<?php 
											if ($row->type_campaign=='cerita'){
											echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
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
										   <?php
										
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row->cerita; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   
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
											if ($row->type_campaign=='cerita'){
											echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
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
											<?php
										
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row->cerita; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->
					 
							<?php } 
echo "				</div>";
						$i++;
						} 
					?>
				<script type="text/javascript">var lastidiklan = <?php echo $lastidiklan; ?>; 
					var lastidcontent = <?php echo $lastidcontent; ?>;					
				</script>
            </div><!-- end .col-md-12 -->
				<div style="clear:both; text-align:center;"><p  id="loader"><img src="<?= base_url()?>image/ajax-loader.gif"></p></div>
				<?php
				if ($lastidiklan != 0 && $lastidcontent !=0) {
					echo '<script type="text/javascript">var lastidiklan = '.$lastidiklan.'; 
						var lastidcontent = '.$lastidcontent.';						
						</script>';
				}

				// sleep for 1 second to see loader, it must be deleted in prodection
					sleep(1);
				?>
            </div><!-- end .col-md-12 -->			
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #term-page -->

<script type="text/javascript">
var basedomain = 'http://lgindonesia.com/lgforyou/';
var is_loading = false; // initialize is_loading by false to accept new loading
var limitiklan = 4; // limit items per page
var limitcontent = 8; // limit items per page
$(function() {
    $(window).scroll(function() {
		//console.log('sss');
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
			//console.log('sas');
            if (is_loading == false) { // stop loading many times for the same page
                // set is_loading to true to refuse new loading
                is_loading = true;
                // display the waiting loader
                $('#loader').show();
				//console.log('sss');
                // execute an ajax query to load more statments
                $.ajax({
					//console.log('ss');
                    url: basedomain+'page/pages',
                    type: 'POST',
                    data: {lastidiklan:lastidiklan, lastidcontent:lastidcontent, limitiklan:limitiklan, limitcontent:limitcontent},
                    success:function(data){
						   //console.log('ss');
                        // now we have the response, so hide the loader
                        $('#loader').hide();
                        // append: add the new statments to the existing data
                        $('#items').append(data);
                        // set is_loading to false to accept new loading
                        is_loading = false;  
						  /*  if(data){
							$('#items').append(data);
							$('#loader').hide();
						}else{
							
							$('#loader').data('<center>No more posts to show.</center>');							
							
						} */  					
                    }
					//$('#loader').hide();
					//is_loading = false; 
                });
            }else{
				$('#loader').data('<center>No more posts to show.</center>');
			}
			//console.log('sss');
			//$('#loader').hide();
       }else{
		   if (is_loading == false) { // stop loading many times for the same page
                // set is_loading to true to refuse new loading
                is_loading = true;
                // display the waiting loader
                $('#loader').show();
				//console.log('sss');
                // execute an ajax query to load more statments
                $.ajax({
					//console.log('ss');
                    url: basedomain+'page/pages',
                    type: 'POST',
                    data: {lastidiklan:lastidiklan, lastidcontent:lastidcontent, limitiklan:limitiklan, limitcontent:limitcontent},
                    success:function(data){
						   //console.log('ss');
                        // now we have the response, so hide the loader
                        $('#loader').hide();
                        // append: add the new statments to the existing data
                        $('#items').append(data);
                        // set is_loading to false to accept new loading
                        is_loading = false;  
						  /*  if(data){
							$('#items').append(data);
							$('#loader').hide();
						}else{
							
							$('#loader').data('<center>No more posts to show.</center>');							
							
						} */  					
                    }
					//$('#loader').hide();
					//is_loading = false; 
                });
            }
	   }
    });
});

</script>