<html>

<head>
<title><?php $title; ?></title>
	
		
	 <link rel="stylesheet" media="all" type="text/css" href="<?= base_url()?>assets/css/style-demo.css">
	 
	 <script src="<?= base_url()?>assets/js/jquery-1.4.3.min.js"></script>
	 <script src="<?= base_url()?>assets/js/jquery.fancybox-1.3.4.pack.js"></script>
	 <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/jquery.fancybox-1.3.4.css" media="screen"></script>
	 <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/stylefancybox.css" ></script>
    <script src="<?= base_url()?>assets/js/jquery-1.11.1.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.easing-1.3.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.mousewheel-3.1.12.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.jcarousellite.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();
});
	</script>
<link rel="stylesheet" href="<?php echo base_url();?>system/css/paging.css" type="text/css">
</head>

<body>
<h3><?php $title; ?></h3>
<br>
<table border="1" width="50%" cellspacing="1" bordercolor="#003366" align="center">
<tr>

<?php
$i=1;

    foreach ($rows as $row) {
	echo "<td width='300'>";
		echo "<p>produk</p><a id='example1' href='". base_url()."upload/".$row->image."'>";
		echo "<img src='".base_url()."upload/".$row->image."' border='0' width='160'></a></td>";
	$i++;
	if (($i==5)or($i==9)or($i==13)or($i==17))echo "</tr>";
	
	if (($i==9)){echo "<tr>";
	foreach ($rows2 as $row2) 
		{
		echo "<td><p>iklan</p><img alt='example2' src='".base_url()."iklan/".$row2->iklan."' border='0' width='200'></td>";
		}
	echo "</tr>";
	
	}
	}
	
	echo "<tr>";
	foreach ($rows3 as $row3) 
		{
		echo "<td><p>iklan</p><img alt='example2' src='".base_url()."iklan/".$row3->iklan."' border='0' width='200'></td>";
		}
	echo"</tr>";		
?>
</table>
<div id="pagination"><center><font size="5">Paging-- <?php echo $halaman;?> --</font></center><div>
</body>

</html>