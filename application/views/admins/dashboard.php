<h2><?php echo $title; ?></h2>
<div class="row">
	<div class="col nav">
		<a class="nav-item nav-link" href="<?php echo base_url(); ?>questions/create_question">Add Question</a>
        <a class="nav-item nav-link" href="<?php echo base_url(); ?>questions/create_choice">Add choices</a>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<table class="users" style="min-width: 60%;">
			<th class="lead text-center text-light bg-secondary" colspan="4">All Users</th>
			<tr>
				<td class="pr-3"><strong>Username</strong></td>
				<td class="pr-3"><strong>Email</strong></td>
				<td class="pr-3"><strong>Join Date</strong></td>
			</tr>
			<?php foreach($users as $user){ ?>
				<tr>
					<td class="pr-3"><?php echo $user['username']; ?></td>
					<td class="pr-3"><?php echo $user['email']; ?></td>
					<td class="pr-3"><?php echo $user['registered_data']; ?></td>
					<td>
						<form method="post" action="<?php echo site_url('admins/delete_user/' .$user['id']); ?>">
							<button class="btn btn-danger btn-sm text-light p-1" type="submit">Delete</button>
						</form>
					</td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>