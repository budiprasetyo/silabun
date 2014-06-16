
	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
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
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
					<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>companies.php/admin/report/report_teguran" target="_blank">
						
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Kode Satker</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Kode Satker" class="form-control" name="kd_satker"maxlength="6" />
						</div>
					  </div><!-- /.form-group -->
					
					  
                      <div class="form-group">
                        <label class="control-label col-lg-4" for="dp2">Tanggal LPJ
                        </label>
                        <div class="col-lg-3">
                          <input type="date" class="form-control" value="02/16/12" data-date-format="mm/dd/yy" id="dp2" name="tgl_lpj" />
                        </div>
                      </div>
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Nomor LPJ</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Kode Satker" class="form-control" name="kd_satker"maxlength="6" />
						</div>
					  </div><!-- /.form-group -->
						
					   
                      <div class="form-group">
                        <label class="control-label col-lg-4" for="dp2">Tanggal Verifikasi
                        </label>
                        <div class="col-lg-3">
                          <input type="date" class="form-control" value="02/16/12" data-date-format="mm/dd/yy" id="dp2" name="tgl_verifikasi" />
                        </div>
                      </div>
						
					  
					  
					  <div class="form-group">
						<label for="text3" class="control-label col-lg-4">Nomor Verifikasi</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Nomor Surat Verifikasi" class="form-control" name="no_verifikasi" maxlength="45" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<div class="col-lg-12 controls">
							<?php 
								$attributes = 'class = "btn btn-primary"';
								echo form_submit('submit', 'Cetak', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->
					  
					</form><!--/form-horizontal-->
					
				  </div><!--/div-1-->
				
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
