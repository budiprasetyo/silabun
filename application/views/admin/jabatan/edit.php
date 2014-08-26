
	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5><?php echo empty($jabatans->id_ref_jabatan) ? 'Tambah Referensi Jabatan' : 'Edit Referensi Jabatan'; ?></h5>
					
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
					<?php echo btn_back('admin/jabatan/', $back_link); ?>
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
					<form class="form-horizontal" method="post" action="">
						
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Nama Jabatan</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Nama Jabatan" class="form-control" name="nm_jabatan" value="<?php echo set_value('nm_jabatan', $jabatans->nm_jabatan); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					<div class="form-group">
				   <label class="control-label col-lg-4">Apakah Pejabat</label>
					<div class="col-lg-8">
					  <div class="checkbox">
						<label>
						  <input class="uniform" type="radio" name="is_boss" value="1" checked>Ya
						</label>
						<label>
						  <input class="uniform" type="radio" name="is_boss" value="0">Tidak
						</label>
					  </div><!-- /.checkbox -->
					</div><!-- /col-lg-8 -->
					</div><!-- /.form-group-->
					  
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
	
	
