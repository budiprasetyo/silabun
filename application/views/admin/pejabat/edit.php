
	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5><?php echo empty($pejabats->id_ref_pejabat) ? 'Tambah Referensi Pejabat' : 'Edit Referensi Pejabat'; ?></h5>
					
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
					<?php echo btn_back('admin/pejabat/', $back_link); ?>
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
					<form class="form-horizontal" method="post" action="">
						
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Nama Pejabat</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Nama Pejabat" class="form-control" name="nm_pejabat" value="<?php echo set_value('nm_pejabat', $pejabats->nm_pejabat); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">NIP Pejabat</label>
						<div class="col-lg-8">
						  <input type="text" id="text2" placeholder="NIP Pejabat" class="form-control" name="nip_pejabat" value="<?php echo set_value('nip_pejabat', $pejabats->nip_pejabat); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Nama Jabatan</label>
						<div class="col-lg-8">
						  <?php 
							echo $dropdown->dropdown_get_name('ref_pejabat', $id, 'id_ref_pejabat', 'id_ref_jabatan', 'nm_jabatan', '- pilih jabatan -', 'ref_jabatan');
						  ?>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<div class="col-lg-12 controls">
							<?php 
								echo form_hidden('id_ref_satker', $id_ref_satker);
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
	
	
