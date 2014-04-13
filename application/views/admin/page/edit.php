<div class="panel panel-default" id="admin-page">
	<div class="panel-heading">
		<div class="panel-title"><?php echo empty($page->static_page_id) ? 'Add Page' : 'Edit Page ' . $page->static_page_title; ?></div>
	</div><!--/panel-heading-->     

	<div style="padding-top:30px" class="panel-body" >
		<?php if (validation_errors()) { ?>
			<div id="login-alert" class="alert alert-danger col-sm-12">
			<?php echo validation_errors(); ?>
			</div>
		<?php } ?>
		
		<form method="post" action="" id="loginform" class="form-horizontal" role="form">
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="static-page-title" type="text" class="form-control" name="static_page_title" value="<?php echo set_value('static_page_title', $page->static_page_title); ?>" placeholder="Static Page Title">                                        
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="static-page-url" type="text" class="form-control" name="static_page_url" value="<?php echo set_value('static_page_url', $page->static_page_url); ?>" placeholder="Static Page URL">
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="keyword" type="text" class="form-control" name="keyword"  value="<?php echo set_value('keyword', $page->keyword); ?>" placeholder="Keyword">
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<input id="categories-id" type="text" class="form-control" name="categories_id" value="<?php echo set_value('categories_id', $page->categories_id); ?>" placeholder="Categories">                             
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="description" type="text" class="form-control" name="description" value="<?php echo set_value('description', $page->description); ?>" placeholder="Description">                                        
			</div>
														
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="author" type="text" class="form-control" name="author" value="<?php echo set_value('author', $page->author); ?>" placeholder="author">                                        
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="image" type="text" class="form-control" name="image" value="<?php echo set_value('image', $page->image); ?>" placeholder="image">                                        
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<!--
					<textarea id="content" class="form-control" name="content" placeholder="content">
						 <?php //echo set_value('content', $page->content); ?>
					</textarea>   
-->
					<textarea name="content" id="content" class="form-control"  placeholder="content">
						 <?php echo set_value('content', $page->content); ?>
					</textarea>
					<?php echo display_ckeditor($ckeditor); ?>                                     
			</div>
			
			<div style="margin-top:10px" class="form-group">
				<div class="col-sm-12 controls">
					<input type="submit" value="Save" id="btn-login" class="btn btn-primary" />
				</div>
				
			</div>
		</form>  
		
	</div><!--/panel-body-->                   
</div><!--/panel panel-info-->  
