<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Upload Image</title>

</head>
<body>
	<form action="<?php echo base_url('upload/upload_file'); ?>" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td> Title </td>
				<td> : </td>
				<td> <input type="text" name="title"> </td>
			</tr>
			<tr>
				<td> Image </td>
				<td> : </td>
				<td> <input type="file" name="image"> </td>
			</tr>
			<tr>
				<td><input type="submit" value="Upload"></td>
			</tr>
		</table>
	</form>
</body>
</html>