<?php $this->load->view('admin/components/header'); ?>

<body class="login">
	<div class="container">  
		                
		<div class="text-center">
			<img src="<?php echo base_url(); ?>assets/css/images/kemenkeu.png" alt="logo" height="50px" />
		</div><!--/text-center-->
		  
            <div class="tab-content" >
				
					<div id="login" class="tab-pane active">
						<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
						<?php } ?>
						<p class="text-muted text-center">
						  Direktorat Sistem Perbendaharaan
						</p>
					</div><!--/login tab-pane active-->     
					
                    <?php $this->load->view($subview); // which is set in controller ?>	  
                    
            </div><!--/tab-content-->  
            
    </div><!--/container-->
    
<?php $this->load->view('admin/components/footer'); ?>
