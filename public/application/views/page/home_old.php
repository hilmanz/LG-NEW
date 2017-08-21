

<section id="banner">
    <div class="container">
       <div class="banner">
            <div class="banner-img">
                <img src="<?= base_url()?>assets/content/banner_home.jpg" />
                <a href="javascript:void(0);"  onclick="jQuery('#bgndVideo').YTPPlay()" class="play" id="playbutton">&nbsp;</a>
                <a href="<?= base_url()."page/prize" ?>" class="promocircle">&nbsp;</a>
                 <a class="logo25th"><img src="<?= base_url()?>assets/images/logo.png"/></a>
            </div>
       </div><!-- end .banner -->
    </div>
</section><!-- end #banner-->
<div class="container">
    <div class="row">
        <div  class="col-md-6">
            <div class="box center">
                <div class="entry">
                	<h3>Once Upon A Time, Me and LG...</h3>
                    <p>Menangkan produk inovatif dari LG dengan menuliskan cerita tentang kesan pertama Anda menggunakan produk LG</p>
                    <a href="<?= base_url()?>page/uploadcerita" class="button">TULIS CERITA</a>
                    
                </div>
            </div><!-- end .box -->
        </div><!-- end .col-md-6 -->
        <div  class="col-md-6">
            <div class="box center">
                <div class="entry">
                    <h3>Start A New Day with LG</h3>
                    <p>Belum pernah menggunakan produk LG? Ikuti kontes ini dan raih kesempatan mendapatkan
    produk LG untuk mengisi rumah Anda</p>
                    <a href="<?= base_url()?>page/uploadphoto" class="button">SUBMIT FOTO</a>
                </div>
            </div><!-- end .box -->
        </div><!-- end .col-md-6 -->
    </div><!-- end .row -->
</div><!-- end .container -->

<script>
  jQuery(function () {

    var isIframe=function(){var a=!1;try{self.location.href!=top.location.href&&(a=!0)}catch(b){a=!0}return a};if(!isIframe()){var logo=$("LOGO LG");$("#wrapper").prepend(logo),$("#logo").fadeIn()}
    var myPlayer = jQuery("#bgndVideo").YTPlayer();
    $('#bgndVideo').on("YTPTime",function(e){
       var currentTime = e.time;
       if(currentTime == 10){
            $("#popupwrapper").fadeIn(1000);
            $("#stopbutton").fadeOut(1000);
            $('#bgndVideo').YTPPause();
       }
    });
  });

</script>
<div id="playercontainerwrapper" class="fullscreens">
  <div id="playercontainer" class="fullscreens"></div>
  <a id="stopbutton" href="javascript:void(0);">SKIP VIDEO <i class="icon-forward"></i></a>
</div>
  <a id="bgndVideo" class="player" data-property="{videoURL:'w2h-ZtMjuKk',containment:'#playercontainer', showControls:true, autoPlay:false, loop:false, vol:50, mute:false, startAt:0, opacity:1, addRaster:true, quality:'small', optimizeDisplay:true}"></a>

<div id="popupwrapper">
    <div id="popup-sugest">
        <div class="popup-entry">
            <div class="container">
                <div class="row">
                    <div  class="col-md-6">
                        <div class="box center">
                            <div class="entry">
                                <h3>Once Upon A Time, Me and LG...</h3>
                                <p>Menangkan produk inovatif dari LG dengan menuliskan cerita tentang kesan pertama Anda menggunakan produk LG</p>
                                <a href="<?= base_url()?>page/uploadcerita" class="button">TULIS CERITA</a>
                                
                            </div>
                        </div><!-- end .box -->
                    </div><!-- end .col-md-6 -->
                    <div  class="col-md-6">
                        <div class="box center">
                            <div class="entry">
                                <h3>Start A New Day with LG</h3>
                                <p>Belum pernah menggunakan produk LG? Ikuti kontes ini dan raih kesempatan mendapatkan
                produk LG untuk mengisi rumah Anda</p>
                                <a href="<?= base_url()?>page/uploadphoto" class="button">SUBMIT FOTO</a>
                            </div>
                        </div><!-- end .box -->
                    </div><!-- end .col-md-6 -->
                </div><!-- end .row -->
            </div><!-- end .container -->

        </div>
    </div>
</div>

