<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="LED">
   <!-- <link rel="shortcut icon" href="images/favicon.png">-->
    <title>LG FOR YOU</title>
    <!--Core CSS -->
    <link href="<?= base_url()?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/slicknav/slicknav.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/flexslider/flexslider.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/eufont/eufont.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/owlcarousel/owl.carousel.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/owlcarousel/owl.theme.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/responsive-tabs/css/responsive-tabs.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/croppic/croppic.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/wowanimate/animate.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/vendor/ytplayer/css/jquery.mb.YTPlayer.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/css/lg.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/css/responsive.css" rel="stylesheet">
	<script src="<?= base_url()?>assets/vendor/jquery.js"></script>
    <script src="<?= base_url()?>assets/vendor/jquery-ui.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
    <script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="<?= base_url()?>assets/vendor/jquery.validate.js"></script>
	<script src="<?= base_url()?>assets/vendor/responsive-tabs/js/jquery.responsiveTabs.js"></script>
    <script src="<?= base_url()?>assets/vendor/jqueryvalidation-bootstraptooltip/jquery-validate.bootstrap-tooltip.min.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-68540880-1', 'auto');
      ga('send', 'pageview');
    </script>
</head>
<body>
<section id="container">
    <header id="header" class="header">
        <div id="top" class="relative">
            <div class="logo">
                <div class="container">
                    <a href="<?= base_url()?>"><img src="<?= base_url()?>assets/images/logo_lg.png"/></a>
                </div>
            </div>
            <div class="navigation">
                    <nav class="navbar nav-collapse">
                          <ul id="menu">
                            <li class="current"><a href="<?= base_url()?>"><span>Home</span></a></li>
                            <li ><a href="<?= base_url()."about" ?>"><span>About</span></a></li>
                            <li ><a href="<?= base_url()."prize" ?>"><span>Prize</span></a></li>
                            <li ><a href="<?= base_url()."gallery" ?>"><span>Gallery</span></a></li>
                          </ul>
                    </nav>
                <div id="navbarmobile"></div>
            </div><!-- end .navigation -->
        </div><!-- end #top -->
    </header><!-- end #header -->
    <section id="main-content">
		
			<?php 
            if(@$_GET['page']==''){
                include("home.php");
            }else if(@$_GET['page']=='landing1'){ 
                include("landing1.php");
            }else if(@$_GET['page']=='landing2'){ 
                include("landing2.php");
            }else if(@$_GET['page']=='gallery'){ 
                include("gallery.php");
            }else if(@$_GET['page']=='term'){ 
                include("term.php");
            }else if(@$_GET['page']=='prize'){ 
                include("prize.php");
            }else if(@$_GET['page']=='uploadcerita'){ 
                include("uploadcerita.php");
            }else if(@$_GET['page']=='uploadphoto'){ 
                include("uploadphoto.php");
            }else{ 
                include("home.php");
            }?>
  </section><!-- end #main-content-->
    <footer id="footer">
    	<div class="container">
        	<div class="row">
            	<div  class="col-md-6">
                    <p class="copy">Copyright &copy; 2015 LG Electronics Indonesia. All Rights Reserved.</p>
                </div>
                <div  class="col-md-6">
                    <div class="footernav">
                            <a href="<?= base_url()?>">Home</a>
                            <a href="<?= base_url()."about" ?>">About</a>
                            <a href="<?= base_url()."prize" ?>">Prizes</a>
                            <a href="<?= base_url()."gallery" ?>">Gallery</a>
                            <a href="<?= base_url()."terms" ?>">Terms &amp; Conditions</a>
                            <div class="socialicon">
                                <a href="http://facebook.com/lgeindonesia" target="_blank"><i class="icon-facebook">&nbsp;</i></a>
                                <a href="http://twitter.com/lgeindonesia" target="_blank"><i class="icon-twitter">&nbsp;</i></a>
                                <a href="http://instagram.com/lgeindonesia" target="_blank"><i class="icon-instagram">&nbsp;</i></a>
                            </div>
                    </div>
                </div>
            </div><!-- end .row -->
        </div><!-- end .container -->
    </footer>
</section><!-- end #container-->

<!--Core js-->
<script src="<?= base_url()?>assets/vendor/slicknav/jquery.slicknav.js"></script>
<script src="<?= base_url()?>assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?= base_url()?>assets/vendor/flexslider/jquery.flexslider-min.js"></script>
<script src="<?= base_url()?>assets/vendor/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= base_url()?>assets/vendor/html2canvas/html2canvas.js"></script>
<script src="<?= base_url()?>assets/vendor/html2canvas/canvas2image.js"></script>
<script src="<?= base_url()?>assets/vendor/croppic/croppic.js"></script>
<script src="<?= base_url()?>assets/vendor/wowanimate/wow.js"></script>
<script src="<?= base_url()?>assets/vendor/tubeplayer/jQuery.tubeplayer.min.js"></script>

<script src="<?= base_url()?>assets/vendor/custom.js"></script>
<!--script for this page-->
</body>
</html>