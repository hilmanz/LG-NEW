<script type="text/javascript">
  /* <![CDATA[ */
  goog_snippet_vars = function() {
    var w = window;
    w.google_conversion_id = 936814794;
    w.google_conversion_label = "m_GxCI6J-WAQytHavgM";
    w.google_remarketing_only = false;
  }
  // DO NOT CHANGE THE CODE BELOW.
  goog_report_conversion = function(url) {
    goog_snippet_vars();
    window.google_conversion_format = "3";
    window.google_is_call = true;
    var opt = new Object();
    opt.onload_callback = function() {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  }
  var conv_handler = window['google_trackConversion'];
  if (typeof(conv_handler) == 'function') {
    conv_handler(opt);
  }
}
/* ]]> */
</script>
<script type="text/javascript"
  src="//www.googleadservices.com/pagead/conversion_async.js">
</script>
<section id="uploadcerita" class="theContainer">
    <div class="container">
        <div class="row">
            <div  class="col-md-12">
                <div class="w100">
                    <div class="heading center">
                        <div class="entry">
                            <h1 class="red">Ceritaku Bersama LG...</h1>
                            <p>Masih ingat pengalaman pertama Anda menggunakan produk LG Anda dahulu? Share cerita paling berkesan Anda bersama LG dan menangkan produk LG terbaru!</p>
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
                                <div class="col-md-6">
                                    <input type="text" placeholder="Alamat*" name="alamat" id="alamat"/>
                                </div>
                                <div class="col-md-6">
                                    <!--<input type="text" placeholder="Provinsi*" name="provinsi" id="provinsi"/>-->
									<div class="customselect">
                                        
										<select name="provinsi" id="provinsi" >
										<option value=''>Pilih Provinsi</option>
										<?php
												if (count($provinsi)) {
												foreach ($provinsi as $key => $list) {												
												echo "<option value='". $list['id'] . "'>" . $list['nama'] . "</option>";
												}		
													}	
												?>
						                  </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea onkeyup="writeText();" id="ceritatext" placeholder="Kesan pertama Anda tentang LG" class="message" name="kesan" maxlength="150"/></textarea>
                                    <input type="hidden"  id="cropvalue" name="imagecrop"/>
                                    <canvas id="ceritacanvas" width="320" height="320"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <div class="customcheck">
                                    <input type="checkbox" name="agree"/>
                                    <span>Saya menyetujui <a href="http://lgindonesia.com/lgforyou/terms">Syarat &amp; Ketentuan</a></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="fr countdown">Maximal 150 Karakter</span>
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
				 <div class="items <?php   if($row->type_campaign=='cerita'){ ?> items-text  <?php  }    ?>">
                    <div class="itemContainer">
                        <i class="ico icon-twitter"></i>
                        <div class="entry">
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
                        </div>
                        <div class="meta">
                                <div class="thumb thumb-small">

								<?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
                                <div class="userdetail">
                                    <span class="userID"><b><?php echo $row->nama_akun; ?></b></span>
                                </div>
                        </div>
                        <div class="sharebox">
                            <div class="sharebox-entry">	
                                <h3>SHARE</h3>          							
								<?php
								$cerita="Bagi cerita pengalaman pertama Anda bersama LG di http://www.LGForYou.com dan menangkan berjuta hadiah menariknya! &hashtags=LGForYou";
								$image="25 tahun LG berinovasi dan menemani keluarga Indonesia. Bagi cerita pengalaman pertama Anda bersama LG di http://www.LGForYou.com dan menangkan berjuta hadiah menariknya! &hashtags=LGForYou";
								$abc = "http://lg.kanadigital.com/public/page/gallery/55f7c1326dd50.png";
								if($row->type_campaign=='cerita'){
									echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
								}else{
									echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
									
								}
								?>
								<a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lg.kanadigital.com/public/','http://lg.kanadigital.com/public/page/gallery/55f7c1326dd50.png','','25 tahun LG berinovasi dan menemani keluarga Indonesia. Bagi cerita pengalaman pertama Anda bersama LG di www.LGForYou.com dan menangkan berjuta hadiah menariknya! #LGForYou')" src="http://lg.kanadigital.com/public/page/gallery/55f7c1326dd50.png"><i class="icon-facebook">&nbsp;</i></a>
							  
							   
							</div>
                        </div>
                    </div><!-- end .itemContainer -->
                </div><!-- end .items -->
				<?php }else{ ?>
                 <div class="items <?php   if($row->type_campaign=='cerita'){ ?> items-text  <?php  }    ?>">
                    <div class="itemContainer">
                        <i class="ico icon-facebook"></i>
                        <div class="entry">
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
                        </div>
                        <div class="meta">
                                <div class="thumb thumb-small"><?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
                                <div class="userdetail">
                                    <span class="userID"><b><?php echo $row->nama_akun; ?></b></span>
                                </div>
                        </div>
                        <div class="sharebox">
                            <div class="sharebox-entry">
                                <h3>SHARE</h3>          
							  
							  <?php
							  $cerita="Bagi cerita pengalaman pertama Anda bersama LG di www.LGForYou.com dan menangkan berjuta hadiah menariknya! &hashtags=LGForYou";
							$image="Produk LG ini siap untuk mengisi ruang kosong dalam rumah Anda. Ikuti kontes foto di  www.LGForYou.com dan dapatkan kejutan hadiah dari LG! &hashtags=LGForYou";
							if($row->type_campaign=='cerita'){
									echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
								}else{
								echo "<a rel='nofollow' class='sharebtn' href='http://twitter.com/intent/tweet?text=".$cerita."' title='Tweet About It!' target='_blank'><i class='icon-twitter'>&nbsp;</i></a>";
									
								}
								?>
							   <a class="sharebtn" href='javascript:void(0)' onclick="shareFB('Cerita','http://lg.kanadigital.com/public/','http://lg.kanadigital.com/public/page/<?php echo $row->image; ?>','','<?php echo $image; ?>')" src="http://lg.kanadigital.com/public/page/gallery/55f7c1326dd50.png"><i class="icon-facebook">&nbsp;</i></a>
							
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
                            <a href="https://www.hartonoelektronika.com/en/lg-top-load-washer-wfsa17hd6.html" target="_blank"><img src="<?= base_url()?>assets/content/ads1.jpg"/></a>
                        </div>
                </div>
                <div class="col-md-6">
                        <div class="ads">
                            <a href="https://www.hartonoelektronika.com/en/lg-home-theatre-in-the-box-bh7540tw.html" target="_blank"><img src="<?= base_url()?>assets/content/ads2.jpg"/></a>
                        </div>
                </div>
            </div>
        </div>
    </section>
</section><!-- end .theContainer-->

<?php if($display_success): ?>
<div class="mfp-bg mfp-ready"></div>    
<div style="overflow-x: hidden; overflow-y: auto;" tabindex="-1" class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-ready"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div id="popup-message" class="popup-container">
        <div class="popup-entry">
            <h3>Terima Kasih Atas Partisipasi Anda!</h3>
            <p>Cerita Anda telah terkirim. Jika telah sesuai dengan syarat dan ketentuan, 
                Anda akan mendapat konfirmasi di email Anda dan cerita yang Anda kirim akan muncul dalam menu Gallery.</p>
                <a href="#" onclick="goog_report_conversion('<?=base_url()?>');"  class="button btnred btnClosePopup">
                    Kembali ke home
                </a>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="popup">
    <div id="popup-message" class="popup-container">
        <!--<div class="popup-entry">
            <h3>Terima Kasih Atas Partisipasi Anda!</h3>
            <p>Cerita Anda telah terkirim. Jika telah sesuai dengan syarat dan ketentuan, 
                Anda akan mendapat konfirmasi di email Anda dan cerita yang Anda kirim akan muncul dalam menu Gallery.</p>
        </div>-->
		<div class="popup-entry">
           
			
          <a href="javascript:;" class="button btnred" onclick="openFbDialog();"> Sign in to Facebook</a>
		  <!-- <button onclick="myFunction()" class="button btnred btnClosePopup"> Sign in to Facebook</button>-->
		   <!--<a onclick="myFunction()" class="button btnred btnClosePopup"> Sign in to Facebook</a>-->
			<a href="javascript:;" class="button btnred" onclick="openTwitterDialog();"> Sign in to Twitter</a>
			 
        </div>
    </div>
</div>

<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript">

    function openFbDialog()
    {
        myWindow=window.open('<?=$login_url?>&display=popup','','width=500,height=300,left=0');
        myWindow.focus();
    }

    function openTwitterDialog()
    {
        myWindow=window.open('<?=base_url()?>page/twitter_auth?display=popup','','width=500,height=300,left=0');
        myWindow.focus();
    }

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
        var remaining = 150 - jQuery('.message').val().length;
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
            alamat: {required: true},
            provinsi: {required: true},
            agree: {required: true}
        },
        messages: {
            nama: "Isi nama Anda",
            tlpn: "Isi nomor telepon Anda",
            produk: "Pilih produk LG yang Anda sukai",
            kesan: "Isi kesan pertama Anda tentang LG",
            email: "Isi alamat email Anda",
            alamat: "Isi alamat rumah Anda",
            provinsi: "Isi Provinsi Anda",
            agree: "Anda harus menyetujui </br> <a href='http://lgindonesia.com/lgforyou/terms'>Syarat dan ketentuan</a>",
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
                url: "<?= base_url() ?>page/upload_cerita",
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
        var kesan = $("#ceritatext").val();
        var produk = $("#produk").val();
        var alamat = $("#alamat").val();
        var provinsi = $("#provinsi").val();

        $.ajax({
                type:"POST",
                url: "<?= base_url() ?>page/insertcerita",
                data: "nama="+nama+"&tlpn="+tlpn+"&email="+email+"&kesan="+kesan+"&produk="+produk+"&alamat="+alamat+"&provinsi="+provinsi,
                beforeSend: function(){
                $("#loading-box").show();
            },
			//console.log('asasas');
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



