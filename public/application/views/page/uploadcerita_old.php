
<section id="uploadcerita" class="theContainer">
    <div class="container">
        <div class="row">
            <div  class="col-md-12">
                <div class="w100">
                    <div class="heading center">
                        <div class="entry">
                            <h1 class="red">Once Upon A Time, Me and LG... 
<a href="#popup-message" id="trigger" class="showPopup">POP</a></h1>
                            <p>Masih ingat pengalaman pertama Anda menggunakan microwave LG Anda dahulu? Share cerita paling berkesan Anda bersama LG dan menangkan produk LG terbaru!</p>
                            <div class="howto"><img src="<?= base_url()?>assets/images/howto_cerita.png"/></div>
                        </div>
                    </div><!-- end .heading -->
                    <div class="content">
						<form id="formcerita" class="theForm" method="post"enctype="multipart/form-data" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Nama*" name="nama" id="nama"/>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="No. Tlpn*" name="tlpn" id="tlpn" class="number"/>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Email*" name="email" id="email"/>
                                </div>
                                <div class="col-md-6">
                                    <div class="customselect">
                                        
										<select name="produk" id="produk" >
										<option value=''>Pilih Produk</option>
										<?php
												if (count($combo)) {
												foreach ($combo as $key => $list) {												
												echo "<option value='". $list['id'] . "'>" . $list['nama'] . "</option>";
												}		
													}	
												?>
						</select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea onkeyup="writeText();" id="ceritatext" placeholder="Kesan pertama Anda tentang LG" class="message" name="kesan" maxlength="140"/></textarea>
                                    <input type="hidden"  id="cropvalue" name="imagecrop"/>
                                    <canvas id="ceritacanvas" width="320" height="320"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <div class="customcheck">
                                    <input type="checkbox" name="agree"/>
                                    <span>Saya menyetujui <a href="<?= base_url() ?>page/term">Syarat &amp; Ketentuan</a></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="fr countdown">Maximal 140 Karakter</span>
                                </div>
                                <div class="col-md-12">
                                    <div class="center pad20"><?php if(isset($ceksatu)){echo $ceksatu;}else{$ceksatu='';} ?>
									<!-- <a href="<?= $login_url ?>" class="button btnred btnClosePopup"> Sign in to Facebook</a>-->
                                        <input id="btnSubmit" type="submit" class="button" value="SUBMIT" />
										
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- end .content -->
                </div>
            </div><!-- end .col-md-12 -->
        </div><!-- end .row -->
    </div><!-- end .container -->
    <section id="recentgallery">
        <div class="container">
            <div id="galleryList" class="owl-carousel">
                <?php foreach ($rows as $row) { if ($row->type_sosmed=='twitter'){?>
				 <div class="items items-text">
                    <div class="itemContainer">
                        <i class="ico icon-twitter"></i>
                        <div class="entry">
                            <span class="photo-entry-text thumb">
                                <?php 
								if ($row->cerita){
								echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
								}else{
									echo "<img src='".base_url()."page/".$row->image."' border='0' width='160'>"; 
								}								
								?>
                            </span>
                        </div>
                        <div class="meta">
                                <div class="thumb thumb-small">

								<?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
                                <div class="userdetail">
                                    <span class="username"><?php echo $row->id_akun; ?></span>
                                    <span class="userID"><?php echo $row->nama_akun; ?></span>
                                </div>
                        </div>
                        <div class="sharebox">
                            <div class="sharebox-entry">
                                <h3>SHARE</h3>								
                                <!--<a rel="nofollow" class="sharebtn" href="http://twitter.com/home?status=LGForYou Ikuti kontes dan raih kejutan hadiah dari LG"" - mantap" title="Tweet About It!" target="_blank"><i class="icon-twitter">&nbsp;</i></a>--> 								
								<?
							   	if ($row->image){
									echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->image."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
									?>
                               <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Photo','http://lg.kanadigital.com/public/page/uploadcerita','http://lg.kanadigital.com/public/page/<?php echo $row->image; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
							   <?
								}
							   ?>
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
																
                              <!--  <a href="http://www.facebook.com/sharer.php" type="box_count" class="sharebtn"><i class="icon-facebook"></i></a> -->
							  <!-- <a class="facebookshare" href="javascript:void(0)" onclick="shareFB('MyBMW','http://lg.kanadigital.com/public/page/uploadcerita','http://lg.kanadigital.com/public/assets/content/ads1.jpg','','Seen the new breed of BMW lately? Take a peek on sss to find out more.')"><i class="icon-facebook">&nbsp;</i></a>-->
							  <!--<a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-related="LG:Lifes Good">Tweet</a>-->
							  
							  <?php
							
							   	if ($row->image){
									echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=LG, Lifes Good 123 ".base_url()."page/".$row->image."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
									?>
                               <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('photo','http://lg.kanadigital.com/public/page/uploadcerita','http://lg.kanadigital.com/public/page/<?php echo $row->image; ?>','','Seen the new campaign LG Take a peek on LG Website to find out more.')"><i class="icon-facebook">&nbsp;</i></a>
							   <?
								}
							   ?>
							
                            </div>
                        </div>
                    </div><!-- end .itemContainer -->
                </div><!-- end .items -->
				<?php } } ?>
            </div><!-- end #galleryList -->
        </div>
    </section>
    <section id="ads">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                        <div class="ads">
                            <a href="#"><img src="<?= base_url()?>assets/content/ads1.jpg"/></a>
                        </div>
                </div>
                <div class="col-md-6">
                        <div class="ads">
                            <a href="#"><img src="<?= base_url()?>assets/content/ads2.jpg"/></a>
                        </div>
                </div>
            </div>
        </div>
    </section>
</section><!-- end .theContainer-->
<div class="popup">
    <div id="popup-message" class="popup-container">
        <!--<div class="popup-entry">
            <h3>Terima Kasih Atas Partisipasi Anda!</h3>
            <p>Cerita Anda telah terkirim. Jika telah sesuai dengan syarat dan ketentuan, 
                Anda akan mendapat konfirmasi di email Anda dan cerita yang Anda kirim akan muncul dalam menu Gallery.</p>
				<?php if (@$user_profile):   ?>
			<a href="<?= base_url()?>page/twitter" class="button btnred btnClosePopup"> Sign in to Twitter</a>
			<?php else: ?>
            <a href="<?= $login_url ?>" class="button btnred btnClosePopup"> Sign in to Facebook</a>
			<a href="<?= base_url()?>page/twitter" class="button btnred btnClosePopup"> Sign in to Twitter</a>
			 <?php endif; ?>
        </div>-->
		<div class="popup-entry">
           
			
         <a href="<?= $login_url ?>" class="button btnred btnClosePopup"> Sign in to Facebook</a>
		 		  <!-- <button onclick="myFunction()" class="button btnred btnClosePopup"> Sign in to Facebook</button>-->
		   <!--<a onclick="myFunction()" class="button btnred btnClosePopup"> Sign in to Facebook</a>-->
			<a href="<?= base_url()?>page/twitter" class="button btnred btnClosePopup"> Sign in to Twitter</a>
			 
        </div>
    </div>
</div>

		

<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript">

    // CANVAS MANIPULATION

      function wrapText(context, text, x, y, maxWidth, lineHeight) {
        var words = text.split(' ');
        var line = '';

        for(var n = 0; n < words.length; n++) {
          var testLine = line + words[n] + ' ';
          var metrics = context.measureText(testLine);
          var testWidth = metrics.width;
          if (testWidth > maxWidth && n > 0) {
            context.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
          }
          else {
            line = testLine;
          }
        }
        context.fillText(line, x, y);
      }
      var canvas = document.getElementById('ceritacanvas');
      var context = canvas.getContext('2d');
      var maxWidth = 300;
      var lineHeight = 28;
      var x = canvas.width / 2;
      var y = 80;
      var text = 'Masih ingat pengalaman pertama Anda menggunakan microwave LG Anda dahulu? Share cerita paling berkesan Anda bersama LG dan menangkan produk LG';

      context.font = 'italic 300 20px Open Sans';
      context.fillStyle = '#c71558';
      context.textAlign = 'center';

      wrapText(context, text, x, y, maxWidth, lineHeight);

    var canvas=document.getElementById("ceritacanvas");
    var ctx=canvas.getContext("2d");
    var theTextArea=document.getElementById('ceritatext');

    function writeText(){
         ctx.clearRect(0,0,canvas.width,canvas.height);
        wrapText(context, theTextArea.value, x, y, maxWidth, lineHeight);
    }
    //COUNT DOWN TEXTAREA
    function updateCountdown() {
        var remaining = 140 - jQuery('.message').val().length;
        jQuery('.countdown').text(remaining + ' Karakter ini lagi.');
    }
     updateCountdown();
    $('.message').change(updateCountdown);
    $('.message').keyup(updateCountdown);

    function resetForm($form) {
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find('input:radio, input:checkbox')
             .removeAttr('checked').removeAttr('selected');
    }
    //FORM VALIDATION
    var form = $( "#formcerita" );
    form.validate({
        rules: {
            nama: {required: true},
            tlpn: {number:true, required: true},
            email: {email:true, required: true},
            produk: {required: true},
            kesan: {required: true},
            agree: {required: true}
        },
        messages: {
            nama: "Isi nama Anda",
            tlpn: "Isi nomor telepon Anda",
            produk: "Pilih produk LG yang Anda sukai",
            kesan: "Isi kesan pertama Anda tentang LG",
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
        submitHandler: function (form) { 
            var dataURL = canvas.toDataURL();
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>page/upload.php",
                data: { 
                   imgBase64: dataURL
                }
            }).done(function(response) {
               // console.log('saved: ' + response); 
                $("#cropvalue").val(response);
                save_via_ajax();
            });
			
             $.magnificPopup.open({
                    items: {
                            src: '#popup-message' 
                    },
                    type: 'inline'
                }, 0);
                return false; 
        }
		
    });
    function save_via_ajax(){    
        var nama = $("#nama").val();        
        var tlpn = $("#tlpn").val();        
        var email = $("#email").val();
		var cerita =  $("#ceritatext").val();
        var cropvalue = $("#cropvalue").val();
        var produk = $("#produk").val();

        $.ajax({
                type:"POST",
                url: "<?= base_url() ?>page/insertcerita",
                data: "nama="+nama+"&tlpn="+tlpn+"&email="+email+"&kesan="+cerita+"&image="+cropvalue+"&produk="+produk,
                beforeSend: function(){
                $("#loading-box").show();
            },
            success: function(pesan){ 
                 resetForm($('#formcerita')); 
            } 
        });
    };
	
		

$('.number').keyup(function () {  	
                if(this.value)
                {
                        this.value = this.value.replace(/[^0-9]/g,''); 
                        
                }
        });		
</script>
<script>
function myFunction() {
	var login_url= 'https://www.facebook.com/dialog/oauth?client_id=533895273426413&redirect_uri=http%3A%2F%2Flg.kanadigital.com%2Fpublic%2Findex.php%2Fpage%2Flogin&state=ced7a9124074d88730c2d959e5f1d8fd&sdk=php-sdk-3.2.3&scope=email';
    window.open(login_url,"_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
}
</script>
<script>
function popupFunction() {
	 $.magnificPopup.open({
                    items: {
                            src: '#popup-message' 
                    },
                    type: 'inline'
                }, 0);
}
</script>
