<div class="panel panel-default" id="admin-page">
	<div class="panel-heading">
		<div class="panel-title">Sign In</div>
		<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
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
					<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
			</div>
										
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="login-password" type="password" class="form-control" name="password" placeholder="password">
			</div>
			<div style="margin-top:10px" class="form-group">
				<div class="col-sm-12 controls">
					<input type="submit" value="login" id="btn-login" class="btn btn-success" />
				</div>
				
			</div>
		</form>  
		
	</div><!--/panel-body-->                   
</div><!--/panel panel-info-->  
