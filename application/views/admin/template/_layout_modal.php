<?php $this->load->view('admin/components/header'); ?>

<body class="login">
	<div class="container">  
		                
		<div class="text-center">
			<img src="<?php echo base_url(); ?>assets/css/images/kemenkeu.png" alt="logo" height="50px" />
		</div><!--/text-center-->
		  
            <div class="tab-content" >
				
					<div id="login" class="tab-pane active">
						<p class="text-muted text-center">
						  Direktorat Jenderal Perbendaharaan
						</p> 
						
						<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
						<?php } ?>
						<?php $this->load->view($subview); // which is set in controller ?>	 <div class="text-center">
							
						
						<ul class="list-inline">
						  <li> <a class="text-muted" href="#signup" data-toggle="tab">Dapatkan Username dan Password</a>  </li>
						</ul>
					
					  </div>
					  
					</div><!--/login tab-pane active-->  
					  
			<div id="signup" class="tab-pane">
				<p class="text-muted text-center">
				  Direktorat Jenderal Perbendaharaan
				</p> 
				<?php if (validation_errors()) { ?>
				<div id="login-alert" class="alert alert-danger col-sm-12">
				<?php echo validation_errors(); ?>
				</div>
				<?php } ?>
				<form method="post" action="" class="form-signin" name="signup">
						<?php echo form_hidden('get', 'username'); ?>
						<input type="text" placeholder="Kode Satker atau Kode KPPN" class="form-control" name="kd_satker" maxlength="6" autofocus="autofocus" />
						
						<button class="btn btn-lg btn-success btn-block" type="submit">Dapatkan !</button>
						
						<ul class="list-inline">
							<li class="text-danger">Tekan tombol F5 untuk kembali ke login</li>
						</ul>
				</form>
			</div>   
                    
            </div><!--/tab-content--> 
            
			
		  
            
    </div><!--/container-->
    
<?php $this->load->view('admin/components/footer'); ?>
