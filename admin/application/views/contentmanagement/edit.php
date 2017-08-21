<div class="content">
            <div class="summary">
            </div><!-- end .summary -->
            <form method="post" action="<?php echo base_url()."Contentmanagement/update"; ?>" class="forms"> 
				<div id="new-project" class="boxcontent">
						<section class="step1">
						<div class="row">
							<label for="name">Nama User<br></label>
							<input id="name" name="nama" type="text"  class="required names" value="<?= $nama ?>"><br>
							<label class="msg_name name_no"  style="color: red;"></label>
						</div><!-- Row untuk Name -->
						
						<div class="row">
							<label for="Phone">Nomor Telp<br></label>
							<input id="Phone" name="notelp" type="text"  class="required telp" value="<?= $notelp ?>"><br>
							<label class="msg_name telp_no"  style="color: red;"></label>
						</div><!-- Row untuk Phone input -->
						
						<div class="row">
							<label for="Facs">Email<br></label>
							<input id="Facs" name="email" type="text"  class="required email" value="<?= $email ?>"><br>
							<label class="msg_name email_no"  style="color: red;"></label>
						</div><!-- Row untuk Phone input -->
						
						
						
                         <div class="row">
                        <input type="hidden" name="submit" value="1">
                        
                        <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="submit" value="SAVE" class="button3 submitsave"  />
                             <a href="<?= base_url()."contentmanagement"?>" class="button4">CANCEL</a>

						</div><!-- end .row -->
						</section>
				</div><!-- end #wizard -->
            </form>
			
			
			
        </div><!-- end .content -->