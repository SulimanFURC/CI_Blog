<h2><?= $title ?></h2>

<ul class="list-group">
  <?php foreach($categories as $cat) : ?>
    <li class="list-group-item"><a href="<?php echo site_url('/categories/posts/'.$cat['id']); ?>"> <?php echo $cat['name']; ?> </a></li>
  <?php endforeach; ?>
</ul>


