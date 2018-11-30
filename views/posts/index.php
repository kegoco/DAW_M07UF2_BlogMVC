<div class="content-right"> <!-- TODO: Poner padding al div... -->
    <a class="btn btn-yellowgreen" href='<?php echo constant('URL'); ?>posts/insert'>Insert post</a>
</div>

<?php echo "</div>" ?>  <!-- Cierra un div que se abre en el finder.php -->

<div class="container">
    <h1 class="title">Listado de los posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>
                    <span>Title</span>
                    <button name="sort" value="title:asc">↑</button>
                    <button name="sort" value="title:desc">↓</button>
                </th>
                <th>
                    <span>Author</span>
                    <button name="sort" value="author:asc">↑</button>
                    <button name="sort" value="author:desc">↓</button>
                </th>
                <th>
                    <span>Content</span>
                    <button name="sort" value="content:asc">↑</button>
                    <button name="sort" value="content:desc">↓</button>
                </th>
                <th>
                    <span>Created date</span>
                    <button name="sort" value="created_date:asc">↑</button>
                    <button name="sort" value="created_date:desc">↓</button>
                </th>
                <th>
                    <span>Modified date</span>
                    <button name="sort" value="modified_date:asc">↑</button>
                    <button name="sort" value="modified_date:desc">↓</button>
                </th>
                <th>
                    <span>Supervisor</span>
                    <button name="sort" value="supervisor:asc">↑</button>
                    <button name="sort" value="supervisor:desc">↓</button>
                </th>
                <th>
                    
                </th>
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
                    <td><?php echo $post->supervisor_name; ?></td>
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