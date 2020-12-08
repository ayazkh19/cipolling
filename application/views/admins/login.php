<div class="ml-auto mr-auto mt-3" style="max-width: 38%;">
	<h2 class=""><?php echo $title; ?></h2>
	<?php if(validation_errors()){
		echo '<div class=" text-center p-0 alert alert-danger mt-0 mb-0">'.form_error('username'). '</div>';
		echo '<div class=" text-center p-0 alert alert-danger mt-0 mb-0">'.form_error('password'). '</div>';
	}
	?>
	<form class="" action="<?php echo site_url('admins/login'); ?>" method="post">
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" type="text" name="username" placeholder="enter your username" autofocus value="<?php echo set_value('username'); ?>">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input class="form-control" type="password" name="password" placeholder="enter your password" autofocus value="<?php echo set_value('password'); ?>">
		</div>
		<button class="btn btn-block btn-danger" type="submit">Login</button>
	</form>	
</div>