<!DOCTYPE html>
<html lang="en">
<head>
<script
		src="<?php echo app()->theme->baseUrl;?>/public/js/jquery.min.js"></script>
	<script
		src="<?php echo app()->theme->baseUrl;?>/public/js/bootstrap.min.js"></script>
	<script
		src="<?php echo app()->theme->baseUrl;?>/public/js/jquery.ui.custom.js"></script>
		<title><?php echo app()->name;?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet"
	href="<?php echo app()->theme->baseUrl;?>/public/css/matrix-style.css" />
<link rel="stylesheet"
	href="<?php echo app()->theme->baseUrl;?>/public/css/matrix-media.css" />
<link
	href="<?php echo app()->theme->baseUrl;?>/public/font-awesome/css/font-awesome.css"
	rel="stylesheet" />
<link
	href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'
	rel='stylesheet' type='text/css'>
	
</head>
<body>
	<?php echo $content;?>
	<script src="<?php echo app()->theme->baseUrl;?>/public/js/matrix.js"></script>
</body>
</html>
