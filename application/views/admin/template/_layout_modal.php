<?php $this->load->view('admin/components/header'); ?>

<body>
	<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-default" >
					<div class="panel-heading">
						<div class="panel-title">Sign In</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
					</div>     
					<div style="padding-top:30px" class="panel-body" >
						
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
                    <?php $this->load->view($subview); // which is set in controller ?>	  
					</div>                     
            </div><!--/panel panel-info-->  
        </div><!--/loginbox-->
    </div><!--/container-->
    
<?php $this->load->view('admin/components/footer'); ?>
