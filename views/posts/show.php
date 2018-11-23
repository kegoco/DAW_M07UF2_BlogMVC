<p><strong>Post #<?php echo $post->id; ?></strong></p>
<p><strong>Title: </strong><?php echo $post->title; ?></p>
<p><strong>Autor: </strong><?php echo $post->author; ?></p>
<p><strong>Post: </strong><?php echo $post->content; ?></p>
<p><strong>Image: </strong><img src="<?php echo constant('URL')."uploads/".$post->image; ?>" width="200"></p>
<p><strong>Created date: </strong><?php echo $post->created_date; ?></p>
<p><strong>Modified date: </strong><?php echo $post->modified_date; ?></p>
<p><strong>Supervisor: </strong><?php echo $post->supervisor; ?></p>