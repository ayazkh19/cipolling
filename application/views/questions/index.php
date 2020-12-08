
<!-- card-->
<div class="card border-top-0 border-right-0">
    <div class="card-header">
        <h2 class="mb-0 mt-0"><?php echo $title; ?></h2>
    </div>
</div>
<div class="mb-5 mt-0">
    <?php foreach ($questions as $q){ ?>
        <div class="card border-top-0 border-left-0 border-right-0">
            <div class="card-body">
                <a class="text-dark" href="<?php echo site_url('questions/detail/'.$q['id']); ?>"><h4><?php echo $q['question_text']; ?> ?</h4></a>
                <?php if($this->session->userdata('is_logged_in') && $this->session->userdata('is_admin_user')){ ?>
                    <form method="post" action="<?php echo base_url(); ?>questions/edit_question/<?php echo $q['id']; ?>">
                        <button class="pt-0 pb-0 btn btn-info btn-sm" type="submit">Edit</button> <a class="pt-0 pb-0 ml-0 btn btn-danger btn-sm" href="<?php echo site_url('questions/delete/' .$q['id']) ?>">&times;</a>
                    </form>
                <?php } ?>
            </div>
        </div>
    <?php }; ?>
</div>
