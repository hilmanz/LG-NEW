<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redirecting....</title>
</head>

<body>
<script type="text/javascript">
	<?php
		echo 'parent.window.opener.location.href = "'.base_url().'page/uploadcerita?success=1";';
	?>
	window.close();
</script>
</body>
</html>
