<div class="content">
            <div class="summary">
            </div><!-- end .summary -->
            <!---<form method="post" enctype="multipart/form-data" action="<?php echo base_url()."jenisproduk/insert"; ?>" class="forms"> --->
			<form id="formjenisproduk" method="post"enctype="multipart/form-data" action="<?php echo base_url()."jenisproduk/insert"; ?>"class="forms">
				<div id="new-project" class="boxcontent">
						<section class="step1">
						<div class="row">
							<label for="name">Nama produk<br></label>
							<input id="nama" name="nama"  placeholder="Nama*" type="text"  ><br>
							
						</div><!-- Row untuk Name -->
						
						<div class="row">
							<label for="Phone">Keterangan<br></label>
							<textarea id="keterangan" cols="100"  placeholder="Keterangan*"  name="keterangan"></textarea><br>
							
						</div><!-- Row untuk Phone input -->
						
						<div class="row">
							<label for="Facs">Banner<br></label>							
							<input name="banner" id="banner"  type="file" class="required"  style="width: 200px;"><br>
							
						</div><!-- Row untuk Phone input -->
						
						
						
                         <div class="row">
                        <input type="hidden" name="submit" value="1">
                        
           
                            <input type="submit" value="SAVE" class="button3 submitsave"  />
                             <a href="<?= base_url()."contentmanagement"?>" class="button4">CANCEL</a>

						</div><!-- end .row -->
						</section>
				</div><!-- end #wizard -->
            </form>
			
			
			
        </div><!-- end .content -->
<script type="text/javascript">		
		
		 //FORM VALIDATION
    var form = $( "#formjenisproduk" );
    form.validate({
        rules: {
            nama: {required: true},
            tlpn: {number:true, required: true},
            email: {email:true, required: true},
            keterangan: {required: true},
            banner: {required: true},
            agree: {required: true}
        },
        messages: {
            nama: "Isi nama produk Anda",
            tlpn: "Isi nomor telepon Anda",
            keterangan: "Isi keterangan produk Anda",
            banner: "Upload banner produk Anda ",
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