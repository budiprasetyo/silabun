<form method="post" action="" class="form-signin" role="form">
        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email" autofocus="autofocus">   
		<input id="login-password" type="password" class="form-control" name="password" placeholder="password">
		<button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
</form>  
<?php 
	if(count($user))
	{
?>
		<h4 class="text-center bg-blue dker">
			&nbsp;<br />
			Username: <?php echo $user->username; ?><br />
			Password: <?php echo $user->password; ?><br />
			&nbsp;
		</h4> 
		
			<ol class="bg-green lter">
				<li>Apabila tidak bisa login, coba lakukan dengan tidak dengan copy paste, ketikkan secara manual.</li>
				<li>Apabila hal pertama telah dilakukan tetap tidak bisa login, hubungi Direktorat Sistem Perbendaharaan, hubungi Service Desk: <span class="label label-danger">Ivan Setiawan</span> di <span class="label label-danger">08562130825</span> atau Developer: <span class="label label-info">Budi Prasetyo</span> di <span class="label label-info">0811383477</span>.</li>
				<br />
			</ol>
<?php
	}
?>
