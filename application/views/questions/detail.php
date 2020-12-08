<!-- <h1><?php //echo $title; ?></h1> -->
<!-- card detail -->

<div class="card-header">
    <h4><?php echo $question['question_text']; ?> ?</h4>
</div>
<!--display user voting status ie already voted,can vote, how to vote-->
<?php if($voted_user != null&&$this->session->userdata('is_logged_in')&&$voted_user->user_id == $this->session->userdata('user_id')&&$voted_user->question_id == $question['id'] && ($voted_user->is_admin == $this->session->userdata('is_admin_user'))){ ?>
    <p class="text-center lead text-secondary">you have voted on this question</p>
<?php }elseif($this->session->userdata('is_logged_in')){ ?>
    <p class="text-center lead text-secondary">Feel free to vote any answer you like !</p>
<?php }else{ ?>
    <p class="text-center lead text-secondary"><a href="<?php echo site_url('users/login') ?>">Login</a>/<a href="<?php echo site_url('users/register') ?>">Register</a> to vote any answer you like !</p>
<?php } ?>

<?php echo validation_errors(); ?>
<?php if($choices){ ?>
<ul class="list-group">
<?php foreach($choices as $c){ ?>
    <?php echo form_open('questions/votes/' .$c['id']. '/' .$question['id']. '/' .$is_admin); ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <input type="hidden" name="choice" id="<?php echo $c['id']; ?>" value="<?php echo $c['id']; ?>">
        <input type="hidden" name="vote" value="<?php echo $c['votes']; ?>">
        <label for="<?php echo $c['id']; ?>"><?php echo $c['choice_text']; ?></label>

        <?php
            if($voted_user != null){ ?>
            <!-- if we have actually voted on this question disable the buttons-->
            <!-- if not log in disable the votting buttons -->
            <?php if($this->session->userdata('is_logged_in')&& ($voted_user->user_id == $this->session->userdata('user_id'))&&($voted_user->question_id == $question['id']) && ($voted_user->is_admin == $this->session->userdata('is_admin_user')) ){ ?>
                <button class="btn btn-info btn-sm" disabled type="submit" style="margin:8px;">
                Vote(s) <span class="badge badge-light"><?php echo $c['votes']; ?></span>
                </button>
            <?php }else{ ?>
                <input type="hidden" name="user" value="<?php echo $this->session->userdata('user_id'); ?>">
                <button class="btn btn-info btn-sm" type="submit" style="margin:8px;">
                Vote(s) <span class="badge badge-light"><?php echo $c['votes']; ?></span>
                </button>
            <?php } ?>

        <?php }else{ ?>
            <!-- if not voted -->
            <?php if(!$this->session->userdata('is_logged_in')){ ?>
                <button class="btn btn-info btn-sm" disabled type="submit" style="margin:8px;">
                Vote(s) <span class="badge badge-light"><?php echo $c['votes']; ?></span>
                </button>
            <?php }else{ ?>
                <input type="hidden" name="user" value="<?php echo $this->session->userdata('user_id'); ?>">
                <button class="btn btn-info btn-sm" type="submit" style="margin:8px;">
                Vote(s) <span class="badge badge-light"><?php echo $c['votes']; ?></span>
                </button>
            <?php } ?>
        <?php } ?>
    </li>
    <?php echo form_close(); ?>
<?php }; ?>
</ul>
<?php }else{ ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            No Choices available for this quesiton.
        </h5>
    </div>
</div>
<?php }; ?>
