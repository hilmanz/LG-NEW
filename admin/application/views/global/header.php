<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
   <head>
	<meta charset="utf-8">
	<title>LG - Content Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <link rel="icon" href="<?= base_url()?>assets/images/favicon-2.png" type="image/x-icon">

    <link href="<?= base_url()?>assets/css/colpick.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/admin-lg.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="<?= base_url()?>assets/css/atooltip.css" rel="stylesheet"  media="screen" />
	<style>
		#textcontent{width:100px; height: 100px;} 
		</style>
	<!-- // IE  // -->
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
    
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.atooltip.js"></script>

	<!--- END ---->
<script type="text/javascript" src="<?= base_url()?>assets/jscripts/tiny_mce/tiny_mce.js"></script>
<!--	<script type="text/javascript" src="assets/js/tinymce/js/tinymce/tinymce.min.js"></script>
<script language="javascript" type="text/javascript" src="assets/js/tinymce/FileBrowser.js"></script>
<script language="javascript" type="text/javascript" src="assets/js/tinymce/FileChooser.js"></script>
<script  language="javascript" type="text/javascript" src="assets/js/tinymce/ImageChooser.js"></script>
 -->
	<script type="text/javascript" src="<?= base_url()?>assets/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.steps.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/colpick.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/php.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/kipagination.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/contentviews.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/contentHelper.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/touchbase.js"></script>
    <script src="<?= base_url()?>assets/js/highcharts.js"></script>
	 <script src="<?= base_url()?>assets/js/highchartHelper.js"></script>
    <!-- <script src="assets/js/modules/exporting.js"></script>-->
	 <script type="text/javascript" src="<?= base_url()?>assets/js/validationkana.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#datepicker").datepicker({dateFormat:"yy-mm-dd"});
			 $("#datepicker2").datepicker({dateFormat:"yy-mm-dd"});
        }); 
    </script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<!--script by fauzi raman -->	
	 <link href="<?= base_url()?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="<?= base_url()?>assets/vendor/jquery.js"></script>
    <script src="<?= base_url()?>assets/vendor/jquery-ui.js"></script>
	<script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="<?= base_url()?>assets/vendor/jquery.validate.js"></script>
	<script src="<?= base_url()?>assets/vendor/responsive-tabs/js/jquery.responsiveTabs.js"></script>
    <script src="<?= base_url()?>assets/vendor/jqueryvalidation-bootstraptooltip/jquery-validate.bootstrap-tooltip.min.js"></script>
</head>
<body>
	<div id="body">
    	<div id="page">
            <div id="sidebar">
              <div id="navbar">
                <ul>
                <li class="adminList"><a class="adminmenu" id="adminmenu"><span class="icon-menu2">&nbsp;</span><span> MENU</span></a></li>
                <div class="subadmin1">
                    <li><a class="" href="<?= base_url()."usermanagement" ?>"><span>User management </span></a></li>
                    <li><a class="" href="<?= base_url()."Contentmanagement" ?>"><span>Content management </span></a></li>
					<li><a class="" href="<?= base_url()."iklan" ?>"><span>Iklan </span></a></li>
					<li><a class="" href="<?= base_url()."jenisproduk" ?>"><span>Jenis produk </span></a></li>
					<li><a class="" href="<?= base_url()."banner" ?>"><span>Banner </span></a></li>
                    <!--<li><a class="" href="list_table"><span>Booking </span></a></li>
                    <li><a class="" href="list_table"><span>Content </span></a></li>
                    <li><a class="" href="list_table"><span>Product &amp; Service </span></a></li>
                </div>-->
                <li class="adminList"><a class="adminmenu2" id="adminmenu2"><span><span class="icon-dashboard">&nbsp;</span> DASHBOARD </span></a></li>
                <!--<div class="subadmin2">
                    <li><a class="" href="list_table"><span>Reporting </span></a></li>
                    <li><a class="" href="list_table"><span>Traffic </span></a></li>
                    <li class="adminList"><a class="adminmenu2" id="adminmenu2"><span><span class="icon-users">&nbsp;</span> ADMIN </span></a></li>
                 </div>-->
                 <div class="subadmin2">
                    <li><a class="" href="<?= base_url()."user" ?>"><span>Users</span></a></li>
                </div>
                </ul>
                
              </div><!---end navbar-->
          </div><!---endsidebar-->
          <div id="top">
            <div class="wrapper menuHeader">
            <a class="logo" href="home">
                <img src="<?= base_url()?>assets/images/logo-login.png">    
            </a>
             <div style="float:left;">
                </div>
               <a class="boxbtn logoutButton" href="indext/logout?reset=1"><span class="ico icon-lock">&nbsp;</span><span>Logout</span></a>
            </div><!-- end .wrapper -->  
            
        </div><!-- end #top -->    
        <div id="thecontent">
