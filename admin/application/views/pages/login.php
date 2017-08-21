<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>LG -- Content Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="prodia">
    <link rel="icon" href="assets/images/favicon-2.png" type="image/x-icon">
    <link href="assets/css/colpick.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/admin-lg.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <!-- // IE  // -->
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
    
    <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
    <!--script by fauzi raman -->	
	 <link href="<?= base_url()?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="<?= base_url()?>assets/vendor/jquery.js"></script>
    <script src="<?= base_url()?>assets/vendor/jquery-ui.js"></script>
	<script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="<?= base_url()?>assets/vendor/jquery.validate.js"></script>
	<script src="<?= base_url()?>assets/vendor/responsive-tabs/js/jquery.responsiveTabs.js"></script>
    <script src="<?= base_url()?>assets/vendor/jqueryvalidation-bootstraptooltip/jquery-validate.bootstrap-tooltip.min.js"></script>

</head>
<?php
if(validation_errors())
{
		echo validation_errors();
}

?>

<body id="login-page">
<div id="body">
        <div class="loginbox">
            
            <!--logo-->
            <div class="logo_login"></div>
			<?php //echo "1";?>
          <!--   <div class="logo_login"></div> -->
           <form name="Form2" method="POST" action="login/validatelogin" id="formlogin">
                <input name="username" placeholder="Username" type="text" id="username" maxlength="20"> 
                <input name="password" placeholder="Password" type="password" id="password" maxlength="20">
                <input id="button" type="submit" name="Submit" value="Login">
                <input type="hidden" name="login" value="1">
            </form> 
        </div><!--loginbox-->
</div><!-- end #body -->            
</body>
</html>


<script type="text/javascript">		
		
		 //FORM VALIDATION
    var form = $( "#formlogin" );
    form.validate({
        rules: {
            username: {required: true},
            tlpn: {number:true, required: true},
            email: {email:true, required: true},
            password: {required: true},
            banner: {required: true},
            agree: {required: true}
        },
        messages: {
            username: "Isi username Anda",
            tlpn: "Isi nomor telepon Anda",
            password: "Isi Password Anda",
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