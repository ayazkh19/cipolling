<h2><?php echo $title; ?></h2>
<p class="lead">Most rated Answer</p>

<?php if($question && $choice && $choice[0]['votes'] > 0){ ?>
	<div class="card w-75">
		<div class="card-header">
			<h3><?php echo $question['question_text']; ?> ?</h3>
		</div>
		<div class="border-0 list-group-item d-flex justify-content-between align-items-center">
			<h4><?php echo $choice[0]['choice_text']; ?></h4>
			<button style="background-color: #343a40" class="btn btn-secondary pl-4 pr-4" disabled>Votes: <?php echo $choice[0]['votes']; ?></button>
		</div>
	</div>
<?php } else{ ?>
	<p class="lead text-secondary">No result is available</p>
<?php } ?>
