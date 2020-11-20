<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>CI Blog </title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">CI Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/posts">Blog</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!-- if user is not logged in  -->
      <?php if(!$this->session->userdata('logged_in')) : ?>
        <li>
          <a class="nav-link" href="<?php echo base_url(); ?>index.php/users/login">Login</a>
        </li>
        <li>
          <a class="nav-link" href="<?php echo base_url(); ?>index.php/users/register">Sign Up</a>
        </li>
      <?php endif ; ?>

      <!-- if user is log in  -->
      <?php if($this->session->userdata('logged_in')) : ?>
        <li>
          <a class="nav-link" href="<?php echo base_url(); ?>index.php/posts/create">Create post</a>
        </li>
        <li>
          <a class="nav-link" href="<?php echo base_url(); ?>index.php/categories/create">Create Category</a>
        </li>
        <li>
          <a class="nav-link" href="<?php echo base_url(); ?>index.php/users/logout">Logout</a>
        </li>
      <?php endif ; ?>
    </ul>
  </div>
</nav>

<div class="container">

<!-- Flash Message for User Registration -->
<?php if($this->session->flashdata('user_registered')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
<?php endif; ?>

<!-- Flash Message for Post Created -->
<?php if($this->session->flashdata('post_created')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
<?php endif; ?>

<!-- Flash Message for Post Updated -->
<?php if($this->session->flashdata('post_updated')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
<?php endif; ?>

<!-- Flash Message for category Created -->
<?php if($this->session->flashdata('category_created')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>
<?php endif; ?>

<!-- Flash Message for login failed -->
<?php if($this->session->flashdata('login_failed')) : ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
<?php endif; ?>

<!-- Flash Message for login SUCCESS -->
<?php if($this->session->flashdata('user_loggedin')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
<?php endif; ?>

<!-- Flash Message for logout -->
<?php if($this->session->flashdata('user_logout')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_logout').'</p>'; ?>
<?php endif; ?>


