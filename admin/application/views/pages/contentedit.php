<div class="content">
            <div class="summary">
            </div><!-- end .summary -->
            <form id="formuser" method="post" action="<?php echo base_url()."usermanagement/update"; ?>" class="forms"> 
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
                             <a href="<?= base_url()."usermanagement"?>" class="button4">CANCEL</a>

						</div><!-- end .row -->
						</section>
				</div><!-- end #wizard -->
            </form>
			
			
			
        </div><!-- end .content -->
		
		<script type="text/javascript">		
		
		 //FORM VALIDATION
    var form = $( "#formuser" );
    form.validate({
        rules: {
            nama: {required: true},
            notelp: {number:true, required: true},
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
            notelp: "Isi nomor telepon Anda",
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