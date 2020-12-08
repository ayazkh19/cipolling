<h2><?php echo $title; ?></h2>
<!-- form -->
<?php echo validation_errors(); ?>
<?php echo form_open('questions/create_choice') ?>
    <div class="input-group flex-nowrap">
        <!-- <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping"> -->
        <input class="form-control" type="text" name="choice" placeholder="Enter Choice Here" autofocus>
    </div>
    <button type="submit" class="mt-3 btn btn-secondary btn-lg btn-block">Add Choice</button>
    <!-- <button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button> -->
<?php echo form_close() ?>
<!-- /form -->

