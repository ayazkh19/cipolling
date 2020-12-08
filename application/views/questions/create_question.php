<h2><?php echo $title; ?></h2>

<div class="lead">Select a Choice for question ! Or Add a new choice<a href="<?php echo site_url('questions/create_choice/') ?>"> here.</a></p></div>
<!-- form -->
<?php echo validation_errors(); ?>
<?php echo form_open('questions/create_question'); ?>
    <div class="input-group mb-3">
        <input class="form-control" type="text" name="question" autofocus placeholder="Enter Question here">
    </div>
<?php if($choices){ ?>
    <div class="choices">
        <?php foreach($choices as $c){ ?>
            
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="radio" name="choice" id="<?php echo $c['id']; ?>" value="<?php echo $c['id']; ?>">
                    </div>
                </div>
                <label style="border-top:none;border-right:none" class="form-control" for="<?php echo $c['id']; ?>"><?php echo $c['choice_text']; ?></label>
                <!-- <label for="" >hello</label> -->
            </div>
        <?php }; ?>
    </div>
    <button type="submit" class="mb-4 mt-4 btn btn-secondary btn-lg btn-block"> Add Question</button>
    <?php }; ?>
<?php echo form_close() ?>

