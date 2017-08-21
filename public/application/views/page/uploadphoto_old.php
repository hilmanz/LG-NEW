<section id="uploadcerita" class="theContainer">
    <div class="container">
        <div class="row">
            <div  class="col-md-12">
                <div class="w100">
                    <div class="heading center">
                        <div class="entry">
                            <h1 class="red">Start A New Day with LG</h1>
                            <p>Tidak perlu menunggu lama untuk menyempurnakan rumah Anda dengan produk LG. Foto ruang kosong yang selalu Anda impikan untuk diisi oleh produk LG dan dapatkan kesempatan untuk menjadikannya menjadi nyata!</p>
                            <div class="howto"><img src="<?= base_url()?>assets/images/howto.png"/></div>
                        </div>
                    </div><!-- end .heading -->
                </div>
                <div class="content">
                    <div id="formupload" class="theForm" style="position:relative;" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="colupload">
                                        <div id="cropContaineroutput"></div>
                                        <div id="img-out"></div>
                                        <a id="btnSave" href="javascript:void(0);"><i class="icon-checkmark"></i></a>
                                        <a id="btnCancel" href="javascript:void(0);"><i class="icon-cancel2"></i></a>
                                    </div>
                                    <div class="colitem">
                                        <a class="proditem" href="javascript:void(0);"><input type="hidden"  id="jns_prod" name="jns_prod" value="1" />
                                            <img  rel="1" class="prodimg" src="<?= base_url()?>assets/content/product/tv.png"/>
                                        </a>
                                        <a  class="proditem" href="javascript:void(0);"><input type="hidden"  id="jns_prod" name="jns_prod" value="2" />
                                            <img rel="2" class="prodimg" src="<?= base_url()?>assets/content/product/kulkas.png"/>
                                        </a>
                                        <a  class="proditem" href="javascript:void(0);" ><input type="hidden"  id="jns_prod" name="jns_prod" value="3" />
                                            <img rel="4" class="prodimg" src="<?= base_url()?>assets/content/product/teather.png"/>
                                        </a>
                                        <a class="proditem" href="javascript:void(0);" ><input type="hidden"  id="jns_prod" name="jns_prod" value="4" />
                                            <img rel="4"  class="prodimg"src="<?= base_url()?>assets/content/product/mesincuci.png"/>
                                        </a>
                                        <a class="proditem" href="javascript:void(0);"><input type="hidden"  id="jns_prod" name="jns_prod" value="5" />
                                            <img  rel="5"  class="prodimg"src="<?= base_url()?>assets/content/product/oven.png"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--<form id="formuploaddata" method="post"enctype="multipart/form-data" action="insertphoto">-->
								<form id="formuploaddata" method="post"enctype="multipart/form-data" action="insertphoto">
                                    <input type="text" placeholder="Nama*" name="nama" id="nama"/>
                                    <input type="text" placeholder="No. Tlpn*" name="tlpn" id="tlpn" class="number"/>
                                    <input type="text" placeholder="Email*" name="email" id="email" required/>
                                    <input type="text"  id="cropvalue" name="imagecrop" style="opacity:0;  position:absolute; left:-110%;"/>
                                  <input type="text"  id="produk" name="produk"  style="opacity:0; position:absolute; left:-60%;" />
                                    <div class="customcheck">
                                        <input type="checkbox" name="agree"/><?php if(isset($ceksatu)){echo $ceksatu;}else{$ceksatu='';} ?>
                                        <span>Saya menyetujui <a href="<?= base_url() ?>page/term">Syarat &amp; Ketentuan</a></span>
                                    </div>
                                    <div class="center pad20">
                                     <input type="submit" class="button" value="SUBMIT" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- end .content -->
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
                                <div class="thumb thumb-small"><?php echo "<img src='".$row->gambar_akun."'/>" ?></div>
                                <div class="userdetail">
                                    <span class="username"><?php echo $row->id_akun; ?></span>
                                    <span class="userID"><?php echo $row->nama_akun; ?></span>
                                </div>
                        </div>
                        <div class="sharebox">
                           <div class="sharebox-entry">
                                <h3>SHARE1</h3>                               
																
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
                                <h3>SHARE2</h3>								
                                <!--<a rel="nofollow" class="sharebtn" href="http://twitter.com/home?status=LGForYou Ikuti kontes dan raih kejutan hadiah dari LG"" - mantap" title="Tweet About It!" target="_blank"><i class="icon-twitter">&nbsp;</i></a>--> 								
								<?php
							
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
        <div class="popup-entry">                     
            <a href="<?= $login_url ?>" class="button btnred btnClosePopup"> Sign in to Facebook</a>			
			<a href="<?= base_url()?>page/twitter" class="button btnred btnClosePopup"> Sign in to Twitter</a>			
        </div>
    </div>
</div>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript">

    $( ".prodimg" ).click(function() {
        $(".dragprodimg").remove();
        var prodid = $(this).attr( "rel" );
        $("#produk").val(prodid);
        var imgsrc = $(this).attr( "src" );
        $(".cropImgWrapper").append($('<img id="dragprodimg" />').addClass('dragprodimg').attr('src',imgsrc));
        //drag product
        (function($) {
            $.fn.drags = function(opt) {

                opt = $.extend({handle:"",cursor:"move"}, opt);

                if(opt.handle === "") {
                    var $el = this;
                } else {
                    var $el = this.find(opt.handle);
                }

                return $el.css('cursor', opt.cursor).on("mousedown", function(e) {
                    if(opt.handle === "") {
                        var $drag = $(this).addClass('draggable');
                    } else {
                        var $drag = $(this).addClass('active-handle').parent().addClass('draggable');
                    }
                    var z_idx = $drag.css('z-index'),
                        drg_h = $drag.outerHeight(),
                        drg_w = $drag.outerWidth(),
                        pos_y = $drag.offset().top + drg_h - e.pageY,
                        pos_x = $drag.offset().left + drg_w - e.pageX;
                    $drag.css('z-index', 1000).parents().on("mousemove", function(e) {
                        $('.draggable').offset({
                            top:e.pageY + pos_y - drg_h,
                            left:e.pageX + pos_x - drg_w
                        }).on("mouseup", function() {
                            $(this).removeClass('draggable').css('z-index', z_idx);
                        });
                    });
                    e.preventDefault(); // disable selection
                }).on("mouseup", function() {
                    if(opt.handle === "") {
                        $(this).removeClass('draggable');
                    } else {
                        $(this).removeClass('active-handle').parent().removeClass('draggable');
                    }
                });

            }
        })(jQuery);
        $('.dragprodimg').drags();
    });


    var croppicContaineroutputOptions = {
            uploadUrl:'<?= base_url()?>page/img_save_to_file.php',
            //cropUrl:'img_crop_to_file.php', 
            //outputUrlId:'cropOutput',
            //modal:false,
            onAfterImgUpload:   function(){ 
                $("#btnSave").addClass("show");
             },
            onReset:    function(){ 
                $("#btnSave").removeClass("show");
             },
             onAfterImgCrop:    function(){
                $("#btnSave").removeClass("show");
             },
            loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
    }
    var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);

    $(function() { 
        $("#btnSave").click(function() { 
            $(this).removeClass("show");
            $("#btnCancel").addClass("show");
            html2canvas($(".cropImgWrapper"), {
                onrendered: function(canvas) {
                    theCanvas = canvas;
                    document.body.appendChild(canvas);
                    $("#img-out").append(canvas);
                    var dataURL = canvas.toDataURL();
                    $("#img-out canvas").src = dataURL;
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url()?>page/upload.php",
                        data: { 
                           imgBase64: dataURL
                        }
                    }).done(function(response) {
                        console.log('saved: ' + response); 
                        $("#cropvalue").val(response);
                    });
                }
            });
        });
    }); 
    $(function() { 
        $("#btnCancel").click(function() { 
		$("#cropvalue").val('');
		$("#imagecrop").val('');
			$("#produk").val('');
            $("#img-out canvas").remove();
            $(this).removeClass("show");
            $("#btnSave").addClass("show");
        });
    }); 
    $("#formuploaddata").validate({
        rules: {
            nama: {required: true},
            tlpn: {number : true, required: true},
            email: {email:true, required: true},
            agree: {required: true},
			produk: {required: true},
			imagecrop:  {required: true}
        },
        messages: {
            nama: "Isi nama Anda",
            tlpn: "Isi nomor telepon Anda",
            email: "Isi alamat email Anda",
            agree: "Anda harus menyetujui </br> <a href='index.php?page=term'>Syarat dan ketentuan</a>",
			imagecrop: "Upload foto Anda",
			produk: 'Pilih produk Anda'
        },
        tooltip_options: {
            email: {trigger:'focus'},
            agree: {placement:'right',html:true}
        },
        errorPlacement: function (error, element) {
            alert(error.text());
        },
        submitHandler: function (form) { 
			save_via_ajax();
             $.magnificPopup.open({
                    items: {
                            src: '#popup-message' 
                    },
                    type: 'inline'
                }, 0);
				
                return false; 
        }
    });
    function clickLink(value) {
	var myLink = value; 
	}
	 function save_via_ajax(){    
        var nama = $("#nama").val();        
        var tlpn = $("#tlpn").val();        
        var email = $("#email").val();
        var cropvalue = $("#cropvalue").val();
        var produk = $("#produk").val();


        $.ajax({
                type:"POST",
                url: "<?= base_url() ?>page/insertphoto",
                data: "nama="+nama+"&tlpn="+tlpn+"&email="+email+"&imagecrop="+cropvalue+"&produk="+produk,
                beforeSend: function(){
                $("#loading-box").show();
            },
            success: function(pesan){ 
                 resetForm($('#formuploaddata')); 
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