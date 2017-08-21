<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Menu</title>
</head>

<body>

<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td width="44" style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">
		<a href="<?= base_url()?>"><img border="0" src="<?= base_url()."assets/"?>images/lg2.png" width="39" height="21"></a></td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td width="67" bgcolor="#FF3399" align="center" style="border-style: none; border-width: medium">
		<font color="#FFFFFF">Menu</font></td>
		<td width="33" style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td width="364" style="border-style: none; border-width: medium">&nbsp;</td>
		<td width="369" style="border-style: none; border-width: medium">
		<p align="center">
		<span style="font-weight: 700; background-color: #FFFFFF">
		<font size="4" color="#FF3399">Once Upon A Time, Me and LG...</font></span></td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
	<tr>
		<td width="364" style="border-style: none; border-width: medium">&nbsp;</td>
		<td width="369" style="border-style: none; border-width: medium">
		<p align="center"><font size="2">Masih</font><font size="2"> ingat 
		pengalaman pertama Anda menggunakan</font></p>
		<p align="center"><font size="2">LG</font><font size="2"> Anda dahulu? 
		Share cerita paling berkesan Anda bersama LG</font></p>
		<p align="center"><font size="2">dan</font><font size="2"> menangkan 
		produk LG</font></p>
		<p align="center">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
	<tr>
		<td width="364" style="border-style: none; border-width: medium">&nbsp;</td>
		<td width="369" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">
		<!--<form method="POST" action="<?= base_url()."menupertama/insert"?>" onsubmit="return closeSelf()">-->
		<form method="POST" id="form" action="" onsubmit="return closeSelf()">
			<!--webbot bot="SaveResults" U-File="C:\xampp\htdocs\LG\_private\form_results.csv" S-Format="TEXT/CSV" S-Label-Fields="TRUE" -->
			<p align="center">&nbsp;</p>
			<p align="center"><input type="text" name="nama" size="25" placeholder="Nama"></p>
			<p align="center"><input type="text" name="notelp" size="25" placeholder="No Telp"></p>
			<p align="center"><input type="text" name="email" size="25" placeholder="Email"></p>
			<p align="center"><input type="text" name="jns_produk" size="25" placeholder="Jenis Produk"></p>
			<p align="center"><textarea rows="2" name="cerita" cols="20" placeholder="Cerita"></textarea></p>
			<p align="center">
			<input type="submit" style="background-color: #FF3399" id="form" onclick="popupUploadForm()"></p>
		</form>
		</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<div style="border-bottom-style: solid; border-bottom-width: 1px; padding-bottom: 1px">
&nbsp;</div>
<p>&nbsp;</p>
<table border="1" width="100%">
	<tr>
	<?php
				$no=0;
				
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
					
					$no++;
				
			?>
		<td align="center" style="border-left-style: solid; border-left-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
		<?php echo $abc . $acc; ?></td>
		
<?php } ?>
		<td align="center" bgcolor="#FF3399" style="border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
		Gallery</td>
	</tr>
</table>
<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<table border="1" width="100%" style="border-width: 0px">
	<tr>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
		<td style="border-style: none; border-width: medium">&nbsp;</td>
	</tr>
</table>
<script type="text/javascript">
function closeSelf(){
    self.close();
    return true;
}
 
function popupUploadForm(){
        var newWindow = window.open('/public/login/', 'form', 'height=500,width=600');
    }

</script>
</body>

</html>
