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
							
						<!--
						<ul class="list-inline">
						  <li> <a class="text-muted" href="#signup" data-toggle="tab">Registrasi User</a>  </li>
						</ul>
						-->
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
						<?php echo form_hidden('register', 'user'); ?>
						<input type="text" placeholder="Username" class="form-control" name="username" maxlength="30" />
						<input type="text" placeholder="Nama Ditampilkan" class="form-control" name="display_name" maxlength="255" />
						<input type="email" placeholder="mail@domain.com" class="form-control" name="email" maxlength="120" />
						<input type="password" placeholder="Password" class="form-control" name="password_hash" maxlength="128" />
						<input type="password" placeholder="Konfirmasi Password" class="form-control" name="password_conf" maxlength="128" />
						<input type="text" placeholder="Nomor Induk Pegawai" class="form-control" name="nip" maxlength="18" />
						<?php 
							echo $dropdown->dropdown_get_name('roles', $id, 'id_roles', 'id_entities', 'entity_desc', '- Pilih Entitas -', 'entities');
						?>
						<input type="text" placeholder="Kode Satker" class="form-control" name="kd_satker" maxlength="6" />
						
						<button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
						
						<ul class="list-inline">
							<li class="text-danger">Tekan tombol F5 untuk kembali ke login</li>
						</ul>
				</form>
			</div>   
            
                    
            </div><!--/tab-content--> 
            
			
		  
            
    </div><!--/container-->
    
<?php $this->load->view('admin/components/footer'); ?>
