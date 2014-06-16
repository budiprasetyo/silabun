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
			<div class="logo">
				<img src="<?php echo base_url(); ?>assets/css/images/kemenkeu.png" width="85px" height="85px" />
			</div>
			<div id="header-mod">
				kementerian keuangan republik indonesia<br />
				direktorat jenderal perbendaharaan
					<div id="header-mod-child">
					kantor wilayah provinsi <br />
					kantor pelayanan perbendaharaan negara <br />
						<div id="header-mod-subchild">
						Jalan <br />
						Telp. Fax. <br />
						Website <br />
						</div>
					</div>
			</div>
			<hr />
	</div><!--/container-->
	<?php 
		echo $content;
	?>
