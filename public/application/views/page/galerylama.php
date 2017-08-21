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
                    <a href="#"><img src="<?= base_url()?>assets/content/ads3.jpg"/></a>
                </div>
				<!-- End Banner -->
				
				<!-- Start Iklan pertama -->
				<?	
					foreach ($rowsiklan as $rowiklan){
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
										<div class='seller'>
											<img src='".base_url()."iklan/hartono.jpg'/>
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
                <div class="galleryLists">
                    <?php 
						$i=1;
						foreach ($rows as $row) { 
							if ($row->type_sosmed=='twitter'){ ?>
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
										   <?php
										if ($row->cerita){
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row->cerita; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
											if ($row->image){
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->image."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
												<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row->image; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
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
											<?php
										if ($row->cerita){
											echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row->cerita; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
											if ($row->image){
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->image."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row->image; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
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
					?>
				</div>
				<!-- End Content Pertama -->
				
				<table width="100%">
					<tr><td>&nbsp;</td></tr>
				</table>
				
				<!-- Start Iklan Kedua -->
				<?	
				foreach ($rowsiklan2 as $row2) {
					echo "<div class='productList'>
						<div class='items-product'>
							<div class='itemContainer'>
								<div class='entry'>
									<span class='productshop thumb'>
									<td><img alt='example2' src='".base_url()."iklan/".$row2->iklan."' border='0' width='200'></td>
									</span>
								</div>
								<div class='meta'>
									<div class='product-title'><span>".$row2->nama."</span></div>
									<div class='price'>
										<span class='discount'>".$row2->hrg_diskon."</span>
										<span>".$row2->harga."</span>
									</div>
									<div class='seller'>
										<img src='".base_url()."iklan/hartono.jpg'/>
									</div>
								</div>
							</div>
						</div>
					</div>";
				}
				?>
				<!-- End Iklan Kedua -->
				
				<table width="100%">
					<tr><td>&nbsp;</td></tr>
				</table>
				
				<!-- Start Content Kedua -->
				<div class="galleryLists">
                    <?php 
						$i=1;
						foreach ($rows4 as $row4) { 
							if ($row4->type_sosmed=='twitter'){ ?>
								<div class="items items-text">
									<div class="itemContainer">
										<i class="ico icon-twitter"></i>
										<div class="entry">
											<span class="photo-entry-text thumb">
												<?php 
												if ($row4->cerita){
												echo "<img src='".base_url()."page/".$row4->cerita."' border='0' width='160'>"; 
												}else{
													echo "<img src='".base_url()."page/".$row4->image."' border='0' width='160'>"; 
												}								
												?>
											</span>
										</div>
										<div class="meta">
											<div class="thumb thumb-small"><?php echo "<img src='".$row4->gambar_akun."'/>" ?></div>
											<div class="userdetail">
												<span class="username"><?php echo $row4->id_akun; ?></span>
												<span class="userID"><?php echo $row4->nama_akun; ?></span>
											</div>
										</div>
										<div class="sharebox">
											<div class="sharebox-entry">
												<h3>SHARE</h3>
											<?php
											if ($row4->cerita){
												echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row4->cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
													?>
											   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row4->cerita; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
											   <?
												}
												if ($row4->image){
													echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row4->image."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
													?>
											   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row4->image; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
											   <?
												}
											   ?>
											</div>
										</div>
									</div><!-- end .itemContainer -->
								</div><!-- end .items -->
							<?php 
							}
						else{ ?>
							<div class="items items-text">
								<div class="itemContainer">
									<i class="ico icon-facebook"></i>
									<div class="entry">
										<span class="photo-entry-text thumb">
											<?php 
											if ($row4->cerita){
											echo "<img src='".base_url()."page/".$row4->cerita."' border='0' width='160'>"; 
											}else{
												echo "<img src='".base_url()."page/".$row4->image."' border='0' width='160'>"; 
											}								
											?>
										</span>
									</div>
									<div class="meta">
										<div class="thumb thumb-small"><?php echo "<img src='".$row4->gambar_akun."'/>" ?></div>
										<div class="userdetail">
											<span class="username"><?php echo $row4->id_akun; ?></span>
											<span class="userID"><?php echo $row4->nama_akun; ?></span>
										</div>
									</div>
									<div class="sharebox">
										<div class="sharebox-entry">
											<h3>SHARE</h3>
											<a rel="nofollow" class="sharebtn" href="http://twitter.com/home?status=LGForYou Ikuti kontes dan raih kejutan hadiah dari LG"" - mantap" title="Tweet About It!" target="_blank"><i class="icon-twitter">&nbsp;</i></a> 
											<?
											if ($row4->cerita){
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row4->cerita; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
											if ($row4->image){
												?>
										   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lgindonesia.com/lgforyou/page/uploadcerita','http://lgindonesia.com/lgforyou/page/<?php echo $row4->image; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
										   <?
											}
										   ?>
										</div>
									</div>
								</div><!-- end .itemContainer -->
							</div><!-- end .items -->

							<?
						}
					}
					?>
                </div>
				<!-- End Content Kedua -->
				 
				<table width="100%">	
					<tr>
						<td>
							<div id="paging_of_outlet_list" class="paging"><center><font size="5"><?php echo $halaman;?> </font></center><div>
						</td>
					</tr>
                </table>
            </div><!-- end .col-md-12 -->			
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #term-page -->