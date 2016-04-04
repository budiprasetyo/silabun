	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5><?php echo empty($user->users_id) ? 'Add Upload' : 'Edit Upload'; ?></h5>
					
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
					<?php echo btn_back('admin/upload/', $back_link); ?>
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
						<span class="label label-danger">Upload ADK Tahun 2014 Tidak Dapat Dilakukan Lagi</span>
					<hr />
					<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>companies.php/admin/upload/sent">
						
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Upload Data</label>
						<div class="col-lg-8">
						  <input type="file" id="text1" placeholder="Upload Data LPJ Bendahara" class="form-control" name="upload_lpj" />
						</div>
					  </div><!-- /.form-group -->
					  
					  
					  <div class="form-group">
						<div class="col-lg-12 controls">
							<?php 
								if($movingpaths == null)
								{
									$attributes = 'class = "btn btn-primary btn-grad"';
								}
								else
								{
									$attributes = 'class = "btn btn-primary btn-grad" disabled = "disabled"';
								}
								echo form_submit('submit', 'Upload', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->
					  
					</form><!--/form-horizontal-->
					
				  </div><!--/div-1-->
				
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
	
	 <!--BEGIN INPUT TEXT FIELDS-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box dark">
					
                  <header>
                    <div class="icons">
                      <i class="glyphicon glyphicon-list-alt"></i>
                    </div>
                    <h5>Output File</h5>

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
                    </div><!-- /.toolbar -->
                  </header>
                  
                  <header>
                      <nav style="padding: 4px;">
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>companies.php/admin/upload/approve">
						  <div class="form-group">
							  
						  <?php 
								// send filenames to approval method
								if (count($penerimaan_newnames))
								{
									$penerimaan_filetemps[] = $penerimaan_newnames;
									echo form_hidden('penerimaan_filetemps', $penerimaan_filetemps);
								}
								if (count($pengeluaran_newnames))
								{
									$pengeluaran_filetemps[] = $pengeluaran_newnames;
									echo form_hidden('pengeluaran_filetemps', $pengeluaran_filetemps);
								}
								
						  ?>
						  
							<div class="col-lg-12 controls">
								<?php 
									if($movingpaths == null)
									{
										$attributes = 'class = "btn btn-default btn-grad" disabled = "disabled"';
									}
									else
									{
										$attributes = 'class = "btn btn-success btn-grad"';
									}
									echo form_submit('submit', 'Approve', $attributes);
								?>
							</div>
						  </div><!--/.form-group -->
						</form><!--/form-horizontal-->
					  </nav>
				  </header>
                  
                  <div id="div-1" class="body">
					
                    <form class="form-horizontal">
						
                      <div class="form-group">
                      </div><!-- /.form-group -->
						<?php 
					
							if($movingpaths == null)
							{
								// show nothing
								echo $message;
							}
							else
							{
								$this->benchmark->mark('code_start');
								foreach (glob($movingpaths . '*.*') as $filenames) 
								{
									
									if( substr(basename($filenames),0,1) === 'K' )
									{
										$file_k = $csvdatas->parse_file($filenames);
										
										if ($file_k !== false) 
										{
											$count_pengeluaran = count($file_k) + 1;
											?>
											
											Jumlah data pengeluaran <span class="label label-danger"><?php echo $count_pengeluaran; ?> records</span>
											<br />
											<hr />
											
											<?php
										}
									}
									else if (substr(basename($filenames),0,5) === 'REF_K') 
									{
										$files = $csvdatas->parse_file($filenames);

										if ($files !== false) 
										{
											$count_rek_pengeluaran = count($files) + 1;
											?>
											
											Jumlah data rekening pengeluaran <span class="label label-danger"><?php echo $count_rek_pengeluaran; ?> records</span> 
											<br />
											<hr />
											
											<?php
										}
									}
									else if( substr(basename($filenames),0,1) === 'T'
											&& substr(basename($filenames),0,8) !== 'T_BALPJP')
									{
										$file_t = $csvdatas->parse_file($filenames);
										
										if ($file_t !== false) 
										{
											$count_penerimaan = count($file_t) + 1;
											?>
											
											Jumlah data penerimaan <span class="label label-info"><?php echo $count_penerimaan; ?> records</span>
											<br />
											<hr />
											<?php
										}
									}
									else if (substr(basename($filenames),0,5) === 'REF_T') 
									{
										$files = $csvdatas->parse_file($filenames);
										
										if ($files !== false) 
										{
											$count_rek_penerimaan = count($files) + 1;
											?>
											
											Jumlah data rekening penerimaan <span class="label label-info"><?php echo $count_rek_penerimaan; ?> records</span>
											<br />
											<hr />

											<?php
										}
									}
									else if (substr(basename($filenames),0,4) === 'LPJP')
									{
										$csvdatas->separator = '|';
										
										$file_lpjp = $csvdatas->parse_file($filenames);
										
										if ($file_lpjp !== false) 
										{
											$count_penerimaan_lpjp = count($file_lpjp) + 1;
											?>
											
											Jumlah data penerimaan <span class="label label-info"><?php echo $count_penerimaan_lpjp; ?> records</span>
											<br />
											<hr />
											<?php
										}
									}
									else if (substr(basename($filenames),0,8) === 'T_BALPJP')
									{
										$csvdatas->separator = '|';
										
										$file_rek_lpjp = $csvdatas->parse_file($filenames, false);
										
										
										if ($file_rek_lpjp !== false) 
										{
											$count_penerimaan_rek_lpjp = count($file_rek_lpjp);
											?>
											
											Jumlah data rekening penerimaan <span class="label label-info"><?php echo $count_penerimaan_rek_lpjp ; ?> records</span>
											<br />
											<hr />
											<?php
										}
										
									}
									else if (substr(basename($filenames),-3,3) === 'LPJ'
											&& substr(basename($filenames),0,2) === 'C1')
									{
										$csvdatas->separator = "\t";
										
										$file_lpjk = $csvdatas->parse_file($filenames, FALSE);
										
										if ($file_lpjk !== false) 
										{
											$count_penerimaan_lpjk = count($file_lpjk);
											?>
											
											Jumlah data pengeluaran <span class="label label-info"><?php echo $count_penerimaan_lpjk; ?> records</span>
											<br />
											<hr />
											<?php
										}
									}
									else if (substr(basename($filenames),-3,3) === 'LPJ'
											&& substr(basename($filenames),0,2) === 'C2')
									{
										$csvdatas->separator = "\t";
										
										$file_rek_lpjk = $csvdatas->parse_file($filenames, false);
										
										
										if ($file_rek_lpjk !== false) 
										{
											$count_penerimaan_rek_lpjk = count($file_rek_lpjk);
											?>
											
											Jumlah data rekening penerimaan <span class="label label-info"><?php echo $count_penerimaan_rek_lpjk ; ?> records</span>
											<br />
											<hr />
											<?php
										}
										
									}
									
								}
								$this->benchmark->mark('code_end');
								?>
								<header>
									<nav style="padding: 4px;">
									<div class="icons">
									  <i class="fa fa-wrench"></i>
									</div>
										<h5>Data Benchmark</h5>
									</nav>
								</header>
								<br />
								<?php
								echo 'Code ini diproses dalam <span class="label label-primary">' . $this->benchmark->elapsed_time('code_start', 'code_end') . ' detik</span>';
								?>
								<br />
								<?php
								echo 'Menggunakan memory sebesar <span class="label label-primary">' . $this->benchmark->memory_usage() . '</span>';
							}
						?>
                    </form><!--/form-horizontal-->
                  </div><!--/div-l-->
                </div>
              </div>
	
	
