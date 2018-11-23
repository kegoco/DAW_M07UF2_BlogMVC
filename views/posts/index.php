<div>
    <div>
        <a href='<?php echo constant('URL'); ?>posts/insert'>Insert post</a>
    </div>

    <p><strong>Listado de los posts:</strong></p>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Content</th>
                <th>Created date</th>
                <th>Modified date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) {?>
                <tr>
                    <td><?php echo $post->title; ?></td>
                    <td><?php echo $post->author; ?></td>
                    <td><?php echo $post->content; ?></td>
                    <td><?php echo $post->created_date; ?></td>
                    <td><?php echo $post->modified_date; ?></td>
                    <td>
                        <a href='<?php echo constant('URL'); ?>posts/show/<?php echo $post->id; ?>'>Read</a>
                        <a href='<?php echo constant('URL'); ?>posts/update/<?php echo $post->id; ?>'>Update</a>
                        <a href='<?php echo constant('URL'); ?>posts/delete/<?php echo $post->id; ?>'>Delete</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>