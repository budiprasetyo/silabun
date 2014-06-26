<div class="panel panel-default" id="admin-page">
	<div class="panel-heading">
		<div class="panel-title"><?php echo empty($user->id_users) ? 'Add User' : 'Edit User'; ?></div>
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
					<input id="login-username" type="text" class="form-control" name="username" value="<?php echo set_value('username', $user->username); ?>" placeholder="username">                                        
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="login-password" type="password" class="form-control" name="password_hash" placeholder="password">
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="login-password" type="password" class="form-control" name="password_conf"  placeholder="password confirmation">
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<input id="login-email" type="text" class="form-control" name="email" value="<?php echo set_value('email', $user->email); ?>" placeholder="email">                             
			</div>
			
			<div style="margin-top:10px" class="form-group">
				<div class="col-sm-12 controls">
					<input type="submit" value="Save" id="btn-login" class="btn btn-primary" />
				</div>
				
			</div>
		</form>  
		
	</div><!--/panel-body-->                   
</div><!--/panel panel-info-->  
