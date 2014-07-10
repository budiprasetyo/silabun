<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title></title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>vendor/bootstrap/dist/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/report.css" />
</head>
<body>
	<div class="container">
<!--
			<div class="logo">
				<img src="<?php echo base_url(); ?>assets/css/images/kemenkeu.png" width="45px" height="45px" />
			</div>
-->
			<div id="header-report">
<!--
				kementerian keuangan republik indonesia<br />
				direktorat jenderal perbendaharaan
-->
					<div id="header-mod-child">
					<?php echo $nm_entity; ?><br />
					</div>
			</div>
<!--
			<hr />
-->
	</div><!--/container-->
	<?php 
		echo $content;
	?>
