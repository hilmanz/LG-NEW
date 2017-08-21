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
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="vendor/slicknav/slicknav.css" rel="stylesheet">
    <link href="vendor/flexslider/flexslider.css" rel="stylesheet">
    <link href="vendor/eufont/eufont.css" rel="stylesheet">
    <link href="vendor/owlcarousel/owl.carousel.css" rel="stylesheet">
    <link href="vendor/owlcarousel/owl.theme.css" rel="stylesheet">
    <link href="vendor/responsive-tabs/css/responsive-tabs.css" rel="stylesheet">
    <link href="vendor/croppic/croppic.css" rel="stylesheet">
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="css/lg.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
	<script src="vendor/jquery.js"></script>
    <script src="vendor/jquery-ui.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.js"></script>
	<script src="vendor/jquery.validate.js"></script>
	<script src="vendor/responsive-tabs/js/jquery.responsiveTabs.js"></script>
    <script src="vendor/jqueryvalidation-bootstraptooltip/jquery-validate.bootstrap-tooltip.min.js"></script>
</head>
<body>
<section id="container">
    <header id="header" class="header">
        <div id="top" class="relative">
            <div class="logo">
                <div class="container">
                    <a href="index.php"><img src="images/logo.png"/></a>
                </div>
            </div>
            <div class="navigation">
                    <nav class="navbar nav-collapse">
                          <ul id="menu">
                            <li class="current"><a href="index.php"><span>Home</span></a></li>
                            <li ><a href="index.php?page=prize"><span>Prize</span></a></li>
                            <li ><a href="index.php?page=gallery"><span>Gallery</span></a></li>
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
                    <p class="copy">Copyright &copy; 2015 LG Electronics. All Rights Reserved.</p>
                </div>
                <div  class="col-md-6">
                    <div class="footernav">
                            <a href="index.php">Home</a>|
                            <a href="index.php?page=prize">Prizes</a>|
                            <a href="index.php?page=gallery">Gallery</a>|
                            <a href="index.php?page=term">Terms &amp; Conditions</a>
                            <div class="socialicon">
                                <a href=""><i class="icon-facebook">&nbsp;</i></a>
                                <a href=""><i class="icon-twitter">&nbsp;</i></a>
                                <a href=""><i class="icon-instagram">&nbsp;</i></a>
                            </div>
                    </div>
                </div>
            </div><!-- end .row -->
        </div><!-- end .container -->
    </footer>
</section><!-- end #container-->

<!--Core js-->
<script src="vendor/slicknav/jquery.slicknav.js"></script>
<script src="vendor/magnific-popup/magnific-popup.js"></script>
<script src="vendor/flexslider/jquery.flexslider-min.js"></script>
<script src="vendor/owlcarousel/owl.carousel.min.js"></script>
<script src="vendor/html2canvas/html2canvas.js"></script>
<script src="vendor/html2canvas/canvas2image.js"></script>
<script src="vendor/croppic/croppic.js"></script>

<script src="vendor/custom.js"></script>
<!--script for this page-->
</body>
</html>