<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <title>Polls App</title>
</head>
<body>
    <div class="container"><!-- start main container div -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="<?php echo base_url(); ?>about">About</a>
                <a class="nav-item nav-link" href="<?php echo base_url(); ?>questions">Questions</a>
                <a class="nav-item nav-link" href="<?php echo base_url(); ?>questions/result">Result</a>
                <!-- if loggedin as admin show these links -->
                <?php if($this->session->userdata('is_admin_user') && $this->session->userdata('username') && $this->session->userdata('is_logged_in')){ ?>
                    <a class="nav-item nav-link" href="<?php echo base_url(); ?>admins/dashboard">Dashboard</a>
                    <a class="nav-item nav-link" href="<?php echo base_url(); ?>admins/profile/<?php echo $this->session->userdata('user_id'); ?>"><span class="text-warning"><?php echo $this->session->userdata('username'); ?></span></a>
                    <a class="nav-item nav-link" href="<?php echo base_url(); ?>admins/logout"><span class="">Logout</span></a>
                <!-- elseif logged in as user show these links -->
                <?php }elseif($this->session->userdata('username') && $this->session->userdata('is_logged_in')){ ?>
                    <a class="nav-item nav-link" href="<?php echo base_url(); ?>users/logout"><span class="text-info">Logout</span></a>
                    <a class="nav-item nav-link" href="<?php echo base_url(); ?>users/profile/<?php echo $this->session->userdata('user_id'); ?>"><span class="text-warning"><?php echo $this->session->userdata('username'); ?></span></a>
                <!-- not logged in -->
                <?php }else{ ?>
                    <a class="nav-item nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
                    <a class="nav-item nav-link" href="<?php echo base_url(); ?>users/register">Sign up</a>
                <?php } ?>                
            </div>
            </div>
        </nav>
        <!-- messages -->
        <?php 
            if($this->session->flashdata('user_registered')){
                echo '<p class="alert alert-success">' .$this->session->flashdata('user_registered'). '</p>';
            }elseif($this->session->flashdata('logged_in')){
                echo '<p class="alert alert-success">' .$this->session->flashdata('logged_in'). '</p>';
            }elseif($this->session->flashdata('logged_in_fail')){
                echo '<p class="alert alert-danger">' .$this->session->flashdata('logged_in_fail'). '</p>';
            }elseif($this->session->flashdata('logged_out')){
                echo '<p class="alert alert-success">' .$this->session->flashdata('logged_out'). '</p>';
            }elseif($this->session->flashdata('already_logged_out')){
                echo '<p class="alert alert-danger">' .$this->session->flashdata('already_logged_out'). '</p>';
            }elseif($this->session->flashdata('logged_in_admin')){
                echo '<p class="alert alert-danger">' .$this->session->flashdata('logged_in_admin'). '</p>';
            }elseif($this->session->flashdata('edit_profile')){
                echo '<p class="alert alert-success">' .$this->session->flashdata('edit_profile'). '</p>';
            }
            ?>