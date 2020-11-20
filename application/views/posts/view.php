<h2> <?php echo $post['title']; ?> </h2>
<small> <?php echo $post['created_at']; ?> </small>
<p> <?php echo $post['body']; ?> </p>

<?php if($this->session->userdata('user_id') == $post['user_id']) : ?>
<?php echo form_open('/posts/delete/'.$post['id']); ?>
  <input type="submit" value="Delete"  class="btn btn-danger">
  <a class="btn btn-secondary" href="edit/<?php echo $post['slug'] ?>">Edit</a>
</form>
<?php endif ; ?>

<hr>