<h2><?= $title ?></h2>
<?php foreach($posts as $post) : ?>

  <h2><?php echo $post['title']; ?></h2>
  <div class="row">
    <div class="col-md-9">
      <small><?php $d= strtotime ($post['created_at']); echo date('Y-m-d',$d); ?></small>
      <span class="badge badge-danger"><?php echo $post['name']; ?></span> 
      <p><?php echo word_limiter($post['body'],30); ?></p>
      <p><a class="btn btn-primary" href="<?php echo site_url('/posts/'.$post['slug']) ?>">Read More</a></p>
    </div>
  </div>

<?php endforeach; ?>