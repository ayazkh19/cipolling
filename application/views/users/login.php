<div class="mt-3 ml-auto mr-auto" style="max-width: 42%;">
	<h2><?php echo $title; ?></h2>

	<?php echo validation_errors(); ?>
	<form action="<?php echo base_url('users/login'); ?>" method="post">
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" type="text" name="username" placeholder="enter your username" value="<?php echo set_value('username'); ?>">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input class="form-control" type="password" name="password" placeholder="enter your password" value="<?php echo set_value('password'); ?>">
		</div>
		<button class="btn btn-block btn-secondary" type="submit">Login</button>
	</form>
</div>