<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>
<form action="<?php echo site_url('questions/update/' .$question['id']); ?>" method="post">
	<div class="input-group w-75">
		<input class="form-control" type="text" name="question" value="<?php echo $question['question_text']; ?>" autofocus>
	</div>
	<br>
	<?php if($choices > 0){ ?>
		<ul class="list-group">
		<?php foreach($choices as $c){ ?>
			<li class="w-75 list-group-item d-flex justify-content-between align-items-center">
				<div class="label-input">
					<input type="radio" name="choice" id="<?php echo $c['id']; ?>" value="<?php echo $c['id']; ?>">
					<label class="ml-2" for="<?php echo $c['id']; ?>"><?php echo $c['choice_text']; ?></label>
				</div>
				<a class="pt-0 pb-0 btn btn-danger btn-sm" 
					href="<?php echo site_url('questions/delete_choice/' .$c['id']. '/' .$question['id']); ?>">
					Delete
				</a>
			</li>		
		<?php }; ?>
		</ul>
	<?php }; ?>
	<button class="mt-3 mb-3 btn btn-secondary btn-block w-75" type="submit">Update</button>
</form>
