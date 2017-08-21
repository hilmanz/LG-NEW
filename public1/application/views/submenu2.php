<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>MENU</title>
</head>

<body>
    <link rel="stylesheet" media="all" type="text/css" href="<?= base_url()?>assets/css/style-demo.css">

    <script src="<?= base_url()?>assets/js/jquery-1.11.1.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.easing-1.3.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.mousewheel-3.1.12.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.jcarousellite.js"></script>
<p>&nbsp;</p>
<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">
		<a href="<?= base_url()?>"><img border="0" src="<?= base_url()."assets/"?>images/lg2.png" width="65" height="32"></a></td>
		<td width="103" style="border-style: none; border-width: medium" bgcolor="#FF0066">
		<p align="center"><font color="#FFFFFF">MENU</font></td>
		<td width="53" style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">
		<p align="center"><b><font size="5" color="#FF0066">
		<span style="background-color: #FFFFFF">Start A New Day with LG</span></font></b></p>
		<p align="center"><font size="2">Tidak perlu menunggu untuk mempunyai 
		rumah Anda<br>
		dengan produk LG. Foto ruang kosong yang selalu Anda impikan<br>
		untuk diisi oleh produk LG dan dapatkan kesempatan untuk<br>
		menjadikannya menjadi nyata!</font></td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td width="271" style="border-style: none; border-width: medium">&nbsp;</td>
		<td width="306" style="border-left-style: none; border-left-width: medium; border-right-style: solid; border-right-width: 1px; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium">
		<form method="POST" action="--WEBBOT-SELF--">
			<!--webbot bot="SaveResults" U-File="C:\xampp\htdocs\LG\_private\form_results.csv" S-Format="TEXT/CSV" S-Label-Fields="TRUE" -->
			<p align="center">
			<?php
			if( !empty($results) ) {
			foreach($results as $img){?>
			<input border="0" src="<?= base_url()."upload/".$img->image?>" id='uploadPreview' name="I1" width="186" height="109" type="image"></p>
			<?php } }?>
		</form>
		</td>
		<td width="298" style="border-left-style: solid; border-left-width: 1px; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium">
		<?php 
		//echo $this->email->print_debugger();
		//echo $msg; ?>
		<form method="POST" enctype="multipart/form-data" action="<?= base_url()."menu2/do_upload"?>">
		
			<p>&nbsp;<input type="text" id="nama" name="nama" size="33" value="<?=set_value('nama')?>" placeholder="Nama"></p>
			<?php echo form_error('nama'); ?>
			<p>&nbsp;<input type="text" id="notelp" name="notelp" size="33" placeholder="No Telp"></p>
			<?php echo form_error('notelp'); ?>
			<p>&nbsp;<input type="text" id="email" name="email" size="33" placeholder="Email"></p>
			<?php echo form_error('email'); ?>
			<p>&nbsp;<input id="userfiles" name="userfiles" type="file" /></p>
			
			 
			<p align="center"><input type="submit" value="Submit"></p>
		</form>
		<p>&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="100%">
	<tr>
	<?php 
		foreach($images as $cont){
					/* if($cont['cerita']!=0&&$cont['image']==0){
						$abc=$cont['cerita'];
					}
					
					else if($cont['image']!=0&&$cont['cerita']==0){
						$abc=$cont['image'];						
					} */
					if($cont['cerita']==0){
						$abc="<img src='".base_url()."upload/".$cont['image']."' alt=''>";
						
					}else{
						$abc='';
					}
					
					if($cont['image']==0){
						$acc=$cont['cerita'];
					}else{
						$acc='';
					}
					
					//$no++;
	?>
                
		<td align="center" style="border-left-style: solid; border-left-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
		<?php echo $abc . $acc; ?></td>
		
		<?php } ?>
		
		<td align="center" bgcolor="#FF3399" style="border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
		Gallery</td>
	</tr>
</table>
<hr>


<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<script type="text/javascript">
        $(function() {
			$( ".popup" ).click(function() {
  //alert( "Tester." );
  window.open('asasa');
});
			
            $(".default .carousel").jCarouselLite({
                btnNext: ".default .next",
                btnPrev: ".default .prev"
            });
        });
    </script>
</body>

</html>

