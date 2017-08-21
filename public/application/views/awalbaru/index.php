

<section id="banner" class="awalbaru wow fadeIn" data-wow-duration="0.5s" data-wow-delay="1s">
    <div class="container">
       <div class="banner">
            <div class="banner-img">
                <img src="<?= base_url()?>assets/content/awalbaru.png" />
                <a href="javascript:void(0);"  class="play" id="playbutton">&nbsp;</a>
                <a href="<?= base_url()."page/prize" ?>" class="promocircle wow bounceIn" data-wow-duration="0.5s" data-wow-delay="2.5s">&nbsp;</a>
                 <a class="logo25th wow bounceIn" data-wow-duration="0.5s" data-wow-delay="2s"><img src="<?= base_url()?>assets/images/25thlg.png"/></a>
            </div>
       </div><!-- end .banner -->
    </div>
</section><!-- end #banner-->
<div class="container">
    <div class="row">
        <div  class="col-md-8 wow slideInLeft" data-wow-duration="1s" data-wow-delay="3s">
            <div class="box center">
                <div class="entry">
                    <h3>Awal Baru Bersama LG</h3>
                    <p class="f16">Kirimkan foto ruang kosong yang ingin Anda isi dengan produk LG, dan menangkan produk LG pertama Anda sekarang juga.</p>
                    <a href="<?= base_url()?>page/uploadphoto" class="button">SUBMIT FOTO</a>
                </div>
            </div><!-- end .box -->
        </div><!-- end .col-md-6 -->
        <div  class="col-md-4 wow slideInRight" data-wow-duration="1s" data-wow-delay="2s">
            <div class="box center">
                <div class="entry">
                    <h4>Sudah Memiliki </br>Produk LG?</h4>
                    <p>Bagi kesan pertama Anda bersama LG untuk memenangkan produk inovatif kami.</p>
                    <a href="<?= base_url()?>mesinwaktu" class="button">TULIS CERITA</a>
                </div>
            </div><!-- end .box -->
        </div><!-- end .col-md-6 -->
    </div><!-- end .row -->
</div><!-- end .container -->

<div id="playercontainerwrapper" class="fullscreens">
  <div id="playercontainer" class="fullscreens">
        <div id='youtube-player-container'> </div>
  </div>
  <a id="stopbutton" href="javascript:void(0);">SKIP VIDEO <i class="icon-forward"></i></a>
</div>
<div id="popupwrapper">
    <div id="popup-sugest">
        <div class="popup-entry">
            <div class="popupawalbaru">
                <div class="row">
                    <div  class="col-md-12">
                        <div class="center">
                            <div class="entry">
                                <a href="<?= base_url()?>page/uploadphoto" class="button">TENTU SAJA</a>
                            </div>
                        </div><!-- end .box -->
                    </div><!-- end .col-md-12 -->
                </div><!-- end .row -->
            </div><!-- end .container -->

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#youtube-player-container").tubeplayer({
        width: 720, // the width of the player
        height: 405 , // the height of the player
        allowFullScreen: "true", // true by default, allow user to go full screen
        initialVideo: "rprd5wGyHZ4", // the video that is loaded into the player
        preferredQuality: "default",// preferred quality: default, small, medium, large, hd720
        onPlay: function(id){}, // after the play method is called
        onPause: function(){}, // after the pause method is called
        onStop: function(){}, // after the player is stopped
        onSeek: function(time){}, // after the video has been seeked to a defined point
        onMute: function(){}, // after the player is muted
        onUnMute: function(){}, // after the player is unmuted
        onPlayerEnded: function(){
            $("#popupwrapper").fadeIn(10);
            $("#stopbutton").fadeOut(10);
        }
    });
});
</script>