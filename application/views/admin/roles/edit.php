
	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5><?php echo empty($roles->id_roles) ? 'Tambahkan Wewenang' : 'Ubah Wewenang'; ?></h5>
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
					<?php echo btn_back('admin/roles/', $back_link); ?>
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
					<form class="form-horizontal" method="post" action="">
						
						
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Nama Entitas</label>
						<div class="col-lg-8">
						  <?php 
							echo $dropdown->dropdown_get_name('roles', $id, 'id_roles', 'id_entities', 'entity_desc', '- pilih entitas -', 'entities');
						  ?>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Deskripsi Wewenang</label>
						<div class="col-lg-8">
							<input type="text" id="text2" placeholder="Deskripsi" class="form-control" name="roles_desc" maxlength="200" value="<?php echo set_value('roles_desc', $roles->roles_desc); ?>" />
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
	
	
