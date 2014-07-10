
	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="glyphicon glyphicon-print"></i>
					</div><!--/icons-->
					<h5>Pencetakan Teguran</h5>
					
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
				
				<div id="div-1"  class="body">
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php 
								echo validation_errors(); 
							} 
						?>
						</div>
					<hr />
					<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>companies.php/admin/report/edit_report_teguran" <?php echo $attributes; ?>>
						
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Nomor Surat Teguran</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Nomor Surat Teguran" class="form-control" name="no_surat_teguran" maxlength="75" />
						</div>
					  </div><!-- /.form-group -->
						
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Jumlah Lampiran</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Jumlah Lampiran" class="form-control" name="jml_lampiran" maxlength="3" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Kode Satker</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Kode Satker" class="form-control" name="kd_satker" maxlength="6" />
						</div>
					  </div><!-- /.form-group -->
					
					  
                      <div class="form-group">
                        <label class="control-label col-lg-4" for="dp2">Tanggal LPJ
                        </label>
                        <div class="col-lg-3">
                          <input type="date" class="form-control"  data-date-format="dd/mm/yy" id="dp2" name="tgl_lpj" />
                        </div>
                      </div>
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Nomor LPJ</label>
						<div class="col-lg-8">
						  <input type="text" id="text2" placeholder="Nomor LPJ" class="form-control" name="no_lpj"maxlength="75" />
						</div>
					  </div><!-- /.form-group -->
						
					   
                      <div class="form-group">
                        <label class="control-label col-lg-4" for="dp2">Tanggal Verifikasi
                        </label>
                        <div class="col-lg-3">
                          <input type="date" class="form-control"  data-date-format="dd/mm/yy" id="dp2" name="tgl_verifikasi" />
                        </div>
                      </div>
						
					  
					  <div class="form-group">
						<label for="text3" class="control-label col-lg-4">Nomor Verifikasi</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Nomor Surat Verifikasi" class="form-control" name="no_verifikasi" maxlength="75" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text5" class="control-label col-lg-4">Nama Pejabat Penanda Tangan</label>
						<div class="col-lg-8">
						  <input type="text" id="text5" placeholder="Nama Pejabat Penanda Tangan" class="form-control" name="nm_pejabat" maxlength="75" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text6" class="control-label col-lg-4">NIP Pejabat Penanda Tangan</label>
						<div class="col-lg-8">
						  <input type="text" id="text6" placeholder="NIP Pejabat Penanda Tangan" class="form-control" name="nip_pejabat" maxlength="18" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<div class="col-lg-12 controls">
							<?php 
								$attributes = 'class = "btn btn-primary btn-grad" target = "_blank"';
								echo form_submit('submit', 'Cetak', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->
					  
					</form><!--/form-horizontal-->
					
				  </div><!--/div-1-->
				
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
