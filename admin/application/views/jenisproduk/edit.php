<div class="content">
            <div class="summary">
            </div><!-- end .summary -->
            <!---<form method="post" enctype="multipart/form-data" action="<?php echo base_url()."jenisproduk/update"; ?>" class="forms"> --->
			<form id="formjenisproduk" method="post"enctype="multipart/form-data" action="<?php echo base_url()."jenisproduk/update"; ?>">
				<div id="new-project" class="boxcontent">
						<section class="step1">
						<div class="row">
							<label for="name">Nama produk<br></label>
							<input id="name" name="nama" type="text"  id="nama" value="<?= $nama ?>"><br>
							<label class="msg_name name_no"  style="color: red;"></label>
						</div><!-- Row untuk Name -->
						
						<div class="row">
							<label for="Phone">Keterangan<br></label>
							<textarea cols="100"   name="keterangan" id="keterangan"><?= $keterangan ?></textarea><br>
							<label class="msg_name telp_no"  style="color: red;"></label>
						</div><!-- Row untuk Phone input -->
						
						<div class="row">
							<label for="Facs">Banner<br></label>
							<img src="<?php echo base_url()."../public/produk/".$banner;?>" style="width: 200px;" >
							<input name="banner"  type="file" style="width: 200px;">
						
						</div><!-- Row untuk Phone input -->
						
						
						
                         <div class="row">
                        <input type="hidden" name="submit" value="1">
                        
                        <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="submit" value="SAVE" class="button3 submitsave"  />
                             <a href="<?= base_url()."jenisproduk"?>" class="button4">CANCEL</a>

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
            banner1: {required: true},
            agree: {required: true}
        },
        messages: {
            nama: "Isi nama produk Anda",
            tlpn: "Isi nomor telepon Anda",
            keterangan: "Isi keterangan produk Anda",
            banner1: "Upload banner produk Anda ",
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