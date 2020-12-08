<h2><?php echo $title; ?></h2>
<div class="row">
	<div class="col-md-7">
		<p class="lead"><span class="text-secondary">Username </span><u><?php echo $user->username; ?></u></p>
		<p class="lead"><span class="text-secondary">Email </span><u><?php echo $user->email; ?></u></p>
		<p class="lead"><span class="text-secondary">Register Date </span><u><?php echo $user->registered_data ?></u></p>
	</div>
	<div class="col-md-5">
		<h2 class="text-secondary">Edit Info</h2>
		<form method="post" action="<?php echo site_url('admins/edit_profile/' .$user->id) ?>">
			<?php echo validation_errors(); ?>
			<div class="form-group">
				<label >Username</label>
				<input class="form-control" type="text" name="username" value="<?php echo $user->username; ?>" autofocus>
			</div>
			<div class="form-group">
				<label >Email</label>
				<input class="form-control" type="email" name="email" value="<?php echo $user->email ?>">
			</div>
			<div class="form-group">
				<label >Password</label>
				<input class="form-control" type="password" name="password">
			</div>
			<div class="form-group">
				<label >Confirm Password</label>
				<input class="form-control" type="password" name="password2">
			</div>
			<button class="btn btn-block btn-danger">Submit</button>
		</form>
	</div>
</div>