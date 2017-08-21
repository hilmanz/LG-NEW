<div class="content">
            <div class="summary">
            </div><!-- end .summary -->
            <form id="formiklan" method="post" enctype="multipart/form-data" action="<?php echo base_url()."iklan/insert"; ?>" class="forms"> 
				<div id="new-project" class="boxcontent">
						<section class="step1">
						<div class="row">
							<label for="name">Nama iklan<br></label>
							<input id="nama" name="nama" type="text"  class="required nama"><br>
						</div><!-- Row untuk Name -->
						<div class="row">
							<label for="name">Iklan<br></label>							
							<input id="iklan" name="iklan" id="iklan"  type="file" class="required"  style="width: 200px;"><br>
						</div><!-- Row untuk Name -->
						<div class="row">
							<label for="name">Harga<br></label>
							<input id="harga" name="harga" type="text"  class="required harga"><br>							
						</div><!-- Row untuk Name -->
						<div class="row">
							<label for="name">Harga diskon<br></label>
							<input id="hrg_diskon" name="hrg_diskon" type="text"  class="required hrgdiskon"><br>							
						</div><!-- Row untuk Name -->
						<div class="row">
							<label for="Phone">Jenis produk<br></label>
							<?php
							echo "<select name='jns_produk' id='jns_produk' class='required'>";
							if (count($combo)) {
							echo "<option value=''>Pilih jenis produk</option>";
								foreach ($combo as $key => $list) {
							if ($list['id']==$jns_produk)$cek="selected";
							echo "<option value='". $list['id'] . "' $cek>" . $list['nama'] . "</option>";
								}		
								}	
							echo "</select>";
							?>
							<br>							
						</div><!-- Row untuk Phone input -->
						
						<div class="row">
							<label for="Facs">Logo toko<br></label>							
							<input name="logo_toko" id="logo_toko"  type="file" class="required"  style="width: 200px;">
							<br>							
						</div><!-- Row untuk Phone input -->
						
						
						
                         <div class="row">
                        <input type="hidden" name="submit" value="1">
                        
                        
                            <input type="submit" value="SAVE" class="button3 submitsave"  />
                             <a href="<?= base_url()."iklan"?>" class="button4">CANCEL</a>

						</div><!-- end .row -->
						</section>
				</div><!-- end #wizard -->
            </form>
			
			
			
        </div><!-- end .content -->
		
<script type="text/javascript">		
		
		 //FORM VALIDATION
    var form = $( "#formiklan" );
    form.validate({
        rules: {
            nama: {required: true},
            tlpn: {number:true, required: true},
            email: {email:true, required: true},
            iklan: {required: true},
            harga: {number:true,required: true},
			hrg_diskon: {number:true,required: true},
            jns_produk: {required: true},
			logo_toko: {required: true},         
            agree: {required: true}
        },
        messages: {
            nama: "Isi nama iklan Anda",
            tlpn: "Isi nomor telepon Anda",
            iklan: "Upload iklan produk Anda",
            harga: "isi harga produk Anda ",
			hrg_diskon: "Isi harga diskon produk Anda ",
			jns_produk: "Isi Jenis produk Anda ",
			logo_toko: "Upload Logo toko Anda ",
            email: "Isi alamat email Anda",
            agree: "Anda harus menyetujui </br> <a href='index.php?page=term'>Syarat dan ketentuan</a>",
        },
        tooltip_options: {
            email: {trigger:'focus'},
            agree: {placement:'right',html:true}
        },
        errorPlacement: function (error, element) {
            alert(error.text());
        },
       		
    });
	</script>