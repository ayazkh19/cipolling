<h1><?php echo $title; ?></h1>
<h2>Welcome to CodeIgniter Polls Application</h2>

<div class="container mt-5">
	<div class="row">
	<!-- latest questions -->
		<div class="col-md-7">
			<h3>Latest Questions</h3>
			<ul>
				<!-- ideally 5 latest questions would be enough -->
				<?php foreach($latest_questions as $q){ ?>
					<li><a href="<?php echo base_url('questions/detail/' .$q['id']); ?>"><?php echo $q['question_text']; ?> ?</a></li>
				<?php } ?>
			</ul>
		</div>

		<!-- top rated Questions -->
		<div class="col-md-5">
			<h3>Top Rated Questions</h3>
			<ul>
				<li>lorem ipsum dummy text</li>
				<li>lorem ipsum dolor set amit </li>
			</ul>
		</div>
	</div>
</div>
