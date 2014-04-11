<?php $this->load->view('admin/components/header'); ?>

<body>
<div id="wrapper">
	<div class="container-fluid" id="main">
				
				<div class="row">
					<div class="container">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><span class="pull-right">ENGLISH INDONESIA</span></div>
					</div>
				</div><!--/row 1-->
				
				<div class="navbar navbar-default" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/css/images/logo.jpg" class="img-responsive" alt="logo" /></a>
						</div>
						<div class="nav-collapse collapse navbar-collapse">
							<ul class="nav navbar-nav pull-right">
								<li><a href="<?php echo base_url(); ?>">HOME</a></li>
								<li><?php echo anchor('company/about', 'ABOUT'); ?></li>
								<li><?php echo anchor('company/products', 'PRODUCTS'); ?></li>
								<li><?php echo anchor('company/services', 'SERVICES'); ?></li>
								<li><?php echo anchor('news/news', 'NEWS'); ?></li>
								<li><?php echo anchor('#', 'CONTACT'); ?></li>
							</ul>
						</div>
					</div><!--/container-->
				</div><!--/navbar navbar-default-->
				
	</div><!--/container-fluid-->
	
	<div class="jumbotron header-mod"></div>
