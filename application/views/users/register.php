<div class="mt-3 ml-auto mr-auto" style="max-width: 42%;">
	
	<h2><?php echo $title; ?></h2>
	<?php echo validation_errors(); ?>
	<form action="<?php echo base_url('users/register'); ?>" method="post">
		<div class="form-group flex-nowrap">
			<label>Username</label>
			<input class="form-control" type="text" name="username" autofocus placeholder="Enter your Username" 
				value="<?php echo set_value('username'); ?>">
		</div>
		<div class="form-group flex-nowrap">
			<label>Email</label>
			<input class="form-control" type="email" name="email" placeholder="Enter your Email" 
				value="<?php echo set_value('email'); ?>">
		</div>
		<div class="form-group flex-nowrap">
			<label>Password</label>
			<input class="form-control" type="password" name="password" placeholder="Enter your Password" 
				value="<?php echo set_value('password'); ?>">
		</div>
		<div class="form-group flex-nowrap">
			<label>Confirm Password</label>
			<input class="form-control" type="password" name="password2" placeholder="Confirm Password" 
				value="<?php echo set_value('password2'); ?>">
		</div>
		<button class="btn btn-block btn-secondary" type="submit">Sign Up</button>
	</form>

</div>