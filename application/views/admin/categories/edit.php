
	<div class="row">
		<div class="col-lg-8">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="fa fa-edit"></i>
					</div><!--/icons-->
					<h5><?php echo empty($user->users_id) ? 'Add Category' : 'Edit Category'; ?></h5>
					
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
					<?php echo btn_back('admin/categories/', $back_link); ?>
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					<hr />
					<form class="form-horizontal" method="post" action="">
						
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-4">Category</label>
						<div class="col-lg-8">
						  <input type="text" id="text1" placeholder="Category" class="form-control" name="categories" value="<?php echo set_value('categories', $categories->categories); ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text2" class="control-label col-lg-4">Description</label>
						<div class="col-lg-8">
							<textarea name="description" id="wysihtml5" class="form-control" rows="10"><?php echo $categories->description; ?></textarea>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text3" class="control-label col-lg-4">Page Type</label>
						<div class="col-lg-8">
						<?php 
							echo $dropdown->dropdown_get_name('cms_categories', $id, 'categories_id', 'page_type_id', 'page_type', '- choose categories -', 'cms_page_type'); 
						?>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Language</label>
						<div class="col-lg-8">
						  <?php 
							echo $dropdown->dropdown_get_name('cms_categories', $id, 'categories_id', 'language_id', 'language', '- choose language -', 'cms_language');
						  ?>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-4">Status</label>
						<div class="col-lg-8">
						  <?php 
							echo $dropdown->dropdown_get_name('cms_categories', $id, 'categories_id', 'status_code', 'status', '- choose status -', 'cms_active_status');
						  ?>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<div class="col-lg-12 controls">
							<?php 
								$attributes = 'class = "btn btn-primary"';
								echo form_submit('submit', 'Save', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->
					  
					</form><!--/form-horizontal-->
				  </div><!--/div-1-->
				
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
	
	
