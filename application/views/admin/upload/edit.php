
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
								$attributes = 'class = "btn btn-primary"';
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
                      <i class="fa fa-edit"></i>
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
                  
                  <div id="div-1" class="body">
                    <form class="form-horizontal">
						
                      <div class="form-group">
                      </div><!-- /.form-group -->
						<?php 
							
							foreach (glob($extractpaths . '*.*') as $filename) 
							{
								
								$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
								//~ 
								foreach ($lines as $line_num => $line) 
								{
									echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
								}
							}
						?>
                    </form><!--/form-horizontal-->
                  </div><!--/div-l-->
                </div>
              </div>
	
	
