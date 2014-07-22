	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5><?php echo empty($user->id_users) ? 'Tambahkan User' : 'Edit User'; ?></h5>
					<!-- .toolbar -->
					<div class="toolbar">
						<nav style="padding: 8px;">
							<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
							  <i class="fa fa-minus"></i>
							</a> 
							<a href="javascript:;" class="btn btn-default btn-xs full-box">
							  <i class="fa fa-expand"></i>
							</a> 
							<a href="javascript:;" class="btn btn-danger btn-xs close-box">
							  <i class="fa fa-times"></i>
							</a> 
						</nav>
					</div><!--/.toolbar-->
				</header>  

				<div id="div-1" class="body">
					<?php echo btn_back('admin/user/home/', $back_link); ?>
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
					<form class="form-horizontal" method="post" action="">
		
						<div class="form-group">
						<label for="text2" class="control-label col-lg-4">Username</label>
						<div class="col-lg-8">
							<input type="text" id="text1" placeholder="Username" class="form-control" name="username" maxlength="30" value="<?php echo set_value('username', $user->username); ?>" />
						</div>
					  </div><!-- /.form-group -->
		
						<div class="form-group">
						<label for="text2" class="control-label col-lg-4">Password</label>
						<div class="col-lg-8">
							<input type="text" id="text2" placeholder="Password" class="form-control" name="password_hash" maxlength="128" value="<?php echo set_value('password', $user->password); ?>" />
						</div>
					  </div><!-- /.form-group -->
		
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Konfirmasi Password</label>
						<div class="col-lg-8">
							<input type="password" id="text3" placeholder="Konfirmasi Password" class="form-control" name="password_conf" maxlength="128" value="<?php echo set_value('password', $user->password); ?>" />
						</div>
					  </div><!-- /.form-group -->
		
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">e-Mail</label>
						<div class="col-lg-8">
							<input type="text" id="text4" placeholder="e-Mail" class="form-control" name="email" maxlength="120" value="<?php echo set_value('email', $user->email); ?>" />
						</div>
					  </div><!-- /.form-group -->
		
					  <hr />
					
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">NIP</label>
						<div class="col-lg-8">
							<input type="text" id="text5" placeholder="Nomor Induk Pegawai" class="form-control" name="nip" maxlength="18" value="<?php echo set_value('nip', $user->nip); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Nama Entitas</label>
						<div class="col-lg-8">
						  <?php 
							echo $dropdown->dropdown_get_name('roles', $id, 'id_roles', 'id_entities', 'entity_desc', '- pilih entitas -', 'entities');
						  ?>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Kode Satker</label>
						<div class="col-lg-8">
							<input type="text" id="text6" placeholder="Kode Satker" class="form-control" name="kd_satker" maxlength="6" value="<?php echo set_value('kd_satker', $user->kd_satker); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<div class="col-lg-12 controls">
							<?php 
								$attributes = 'class = "btn btn-primary"';
								echo form_submit('submit', 'Simpan', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->
					  
					</form><!--/form-horizontal-->
				  </div><!--/div-1-->
				
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
