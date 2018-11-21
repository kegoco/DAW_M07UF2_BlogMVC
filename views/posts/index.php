<p><strong>Listado de los posts:</strong></p>
<?php foreach ($posts as $post) {?>
 <p>
 <?php echo $post->author; ?>
 <a href='<?php echo constant('URL'); ?>posts/show/<?php echo $post->id; ?>'>Ver contenido</a>
 </p>
<?php }?>