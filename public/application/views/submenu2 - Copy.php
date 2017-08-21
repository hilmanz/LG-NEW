<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>MENU</title>
</head>

<body>

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
			<input border="0" src="<?= base_url()."assets/"?>images/lg.jpg" id='uploadPreview' name="I1" width="186" height="109" type="image"></p>
			
		</form>
		</td>
		<td width="298" style="border-left-style: solid; border-left-width: 1px; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium">
		<form method="POST" enctype="multipart/form-data" action="<?= base_url()."menu2/insert"?>">
			<!--webbot bot="FileUpload" U-File="C:\xampp\htdocs\LG\_private\form_results.csv" S-Format="TEXT/CSV" S-Label-Fields="TRUE" -->
			<p>&nbsp;<input type="text" name="nama" size="33" placeholder="Nama"></p>
			<p>&nbsp;<input type="text" name="no_telp" size="33" placeholder="No Telp"></p>
			<p>&nbsp;<input type="text" name="email" size="33" placeholder="Email"></p>
			<p>&nbsp;<input type="file" class="myfile imgbanner" id="myfile" name="myfile" /></p>
			 
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
						$abc="<img src='".base_url()."uploads/".$cont['image']."' alt=''>";
						
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

</body>

</html>
<script>
function readImage(file) {

    var reader = new FileReader();
    var image  = new Image();

    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
		
			//if(w=='970' && h=='480')
			//{			con
			console.log('previe');
            $('#uploadPreview').html('<img src="'+ this.src +'">');
			
			//}else{
			//alert('( Ukuran file harus 970 px * 480 px )');
			//$(".imgbanner").val('');
			//return false;
			
			//}
        };
        image.onerror= function() {
            alert('Silahkan unggah ulang menggunakan file dengan format JPG, JPEG atau PNG');
        };      
    };

}
 
$('.browsfile').click(function(e)
 {

			$(".myfile").trigger('click');

			thiss= $(".myfile");
 
			thiss.change(function(e)
			{
		  // console.log(this.files[0].size);
			   e.preventDefault();
			 
			if(this.files[0].size != '')
			   {
				if(this.files[0].size > 2000000)
				{
					alert ('Maaf, Anda hanya bisa mengunggah foto maksimum 2MB');
					$(".imgbanner").val('');
					return false;
					
				}				
				if(this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/png')
				{
					 alert('Silahkan unggah ulang menggunakan file dengan format JPG, JPEG atau PNG');
					 $(".imgbanner").val('');
					 return false;
					
				}
				
			  }
			  
				var F = this.files;
				if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );
				
			});
			});
</script>
