
	<div class="row">
		<div class="col-lg-10">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5><?php echo empty($satker->id_ref_satker) ? 'Tambahkan Satuan Kerja' : 'Ubah Satuan Kerja'; ?></h5>
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
					<?php echo btn_back('admin/satker/', $back_link); ?>
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
					<form class="form-horizontal" id="validVal" method="post" action="">
					
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Kementerian</label>
						<div class="col-lg-8">
							<select data-placeholder="Pilih Kementerian" id="mark" name="id_ref_kementerian" class="form-control chzn-select">
								<option value="">Cari Kementerian</option>
								<?php 
									
									foreach ($get_kementerians as $get_kementerian) 
									{
										if ($kementerian->id_ref_kementerian === $get_kementerian->id_ref_kementerian) 
										{
								?>
											<option value="<?php echo $get_kementerian->id_ref_kementerian; ?>" selected="selected"><?php echo $get_kementerian->kd_kementerian . ' - ' . $get_kementerian->nm_kementerian; ?></option>
								<?php
										}
										else
										{
								?>
											<option value="<?php echo $get_kementerian->id_ref_kementerian; ?>"><?php echo $get_kementerian->kd_kementerian . ' - ' . $get_kementerian->nm_kementerian; ?></option>
								<?php
										}
									}
								?>
							</select>
						</div>
					  </div><!-- /.form-group -->
						
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Eselon I</label>
						<div class="col-lg-8">
							<select data-placeholder="Pilih Eselon I" id="series" name="id_ref_unit" class="form-control">
								<option value="">- Ketik Kode Unit -</option>
								<?php 
									foreach ($get_kementerian_units as $get_unit) 
									{
										if ($satker->id_ref_unit === $get_unit->id_ref_unit) 
										{
								?>
											<option value="<?php echo $get_unit->id_ref_unit; ?>" class="<?php echo $get_unit->id_ref_kementerian; ?>" selected="selected"><?php echo $get_unit->kd_unit . ' - ' . $get_unit->nm_unit; ?></option>
								<?php
										}
										else
										{
								?>
											<option value="<?php echo $get_unit->id_ref_unit; ?>" class="<?php echo $get_unit->id_ref_kementerian; ?>"><?php echo $get_unit->kd_unit . ' - ' . $get_unit->nm_unit; ?></option>
								<?php
										}
									}
								?>
							</select>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Provinsi</label>
						<div class="col-lg-8">
							<select data-placeholder="Pilih Provinsi" id="parent" name="id_ref_lokasi" class="form-control chzn-select">
								<option value="">Cari Provinsi</option>
								<?php 
									foreach ($get_provinsis as $get_provinsi) 
									{
										if ($lokasi->id_lokasi === $get_provinsi->id_ref_lokasi) 
										{
								?>
											<option value="<?php echo $get_provinsi->id_ref_lokasi; ?>" selected="selected"><?php echo $get_provinsi->kd_lokasi . ' - ' . $get_provinsi->nm_lokasi; ?></option>
								<?php
										}
										else
										{
								?>
											<option value="<?php echo $get_provinsi->id_ref_lokasi; ?>"><?php echo $get_provinsi->kd_lokasi . ' - ' . $get_provinsi->nm_lokasi; ?></option>
								<?php
										}
									}
								?>
							</select>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Kabupaten/Kota</label>
						<div class="col-lg-8">
							<select data-placeholder="Pilih Kabupaten/Kota" id="child" name="id_ref_kabkota" class="form-control">
								<option value="">- Ketik Kode Kabupaten/Kota -</option>
								<?php 
									foreach ($get_provinsi_kabkotas as $get_kabkota) 
									{
										if ($satker->id_ref_kabkota === $get_kabkota->id_ref_kabkota) 
										{
								?>
											<option value="<?php echo $get_kabkota->id_ref_kabkota; ?>" class="<?php echo $get_kabkota->id_ref_lokasi; ?>" selected="selected"><?php echo $get_kabkota->kd_kabkota . ' - ' . $get_kabkota->nm_kabkota; ?></option>
								<?php
										}
										else
										{
								?>
											<option value="<?php echo $get_kabkota->id_ref_kabkota; ?>" class="<?php echo $get_kabkota->id_ref_lokasi; ?>"><?php echo $get_kabkota->kd_kabkota . ' - ' . $get_kabkota->nm_kabkota; ?></option>
								<?php
										}
									}
								?>
							</select>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Kode Satker</label>
						<div class="col-lg-8">
							<input type="text" id="text2" placeholder="Kode Satker" class="form-control autotab" tabindex="11" name="kd_satker" maxlength="6" value="<?php echo set_value('kd_satker', $satker->kd_satker); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Nomor Karwas</label>
						<div class="col-lg-8">
							<input type="text" id="text2" placeholder="Nomor Karwas" class="form-control autotab" tabindex="12" name="no_karwas" maxlength="4" value="<?php echo set_value('no_karwas', $satker->no_karwas); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Nama Satker</label>
						<div class="col-lg-8">
							<input type="text" id="text2" placeholder="Nama Satker" class="form-control autotab" tabindex="13" name="nm_satker" maxlength="200" value="<?php echo set_value('nm_satker', $satker->nm_satker); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Status Satker</label>
						<div class="col-lg-8">
						   <?php 
								switch ($satker->aktif) {
									case '0':
										$aktif_checked = '';
									break;
									case '1':
										$aktif_checked = 'checked';
									default :
										$aktif_checked = 'checked';
									break;
								}
								
						   ?>
                           <input name="aktif" class="make-switch" type="checkbox" data-off-color="danger" data-off-text="Tidak" data-on-color="primary" data-on-text="Aktif" <?php echo $aktif_checked; ?> />
                           <span class="label label-danger">Apabila Satker non aktif maka otomatis status LPJ menjadi tidak wajib</span>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Status LPJ Pengeluaran</label>
						<div class="col-lg-8">
						   <?php 
								switch ($satker->lpj_status_pengeluaran) {
									case '0':
										$lpj_checked = '';
									break;
									case '1':
										$lpj_checked = 'checked';
									default :
										$lpj_checked = 'checked';
									break;
								}
								
						   ?>
                           <input name="lpj_status_pengeluaran" class="make-switch" type="checkbox" data-off-color="danger" data-off-text="Tidak" data-on-color="primary" data-on-text="Wajib" <?php echo $lpj_checked; ?> />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Status LPJ Penerimaan</label>
						<div class="col-lg-8">
						   <?php 
								switch ($satker->lpj_status_penerimaan) {
									case '0':
										$lpj_checked = '';
									break;
									case '1':
										$lpj_checked = 'checked';
									default :
										$lpj_checked = 'checked';
									break;
								}
								
						   ?>
                           <input name="lpj_status_penerimaan" class="make-switch" type="checkbox" data-off-color="danger" data-off-text="Tidak" data-on-color="primary" data-on-text="Wajib" <?php echo $lpj_checked; ?> />
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
	
	
