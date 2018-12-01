<div class="content-right">
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
                    <button class="sort-icon" name="sort" value="title:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="title:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    <span>Author</span>
                    <button class="sort-icon" name="sort" value="author:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="author:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    <span>Content</span>
                    <button class="sort-icon" name="sort" value="content:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="content:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    <span>Created date</span>
                    <button class="sort-icon" name="sort" value="created_date:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="created_date:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    <span>Modified date</span>
                    <button class="sort-icon" name="sort" value="modified_date:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="modified_date:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    <span>Supervisor</span>
                    <button class="sort-icon" name="sort" value="supervisor:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="supervisor:desc"><i class="fas fa-arrow-circle-down"></i></button>
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
                    <td class="td-action">
                        <a class="btn btn-blue" href='<?php echo constant('URL'); ?>posts/show/<?php echo $post->id; ?>'>Read</a>
                        <a class="btn btn-green" href='<?php echo constant('URL'); ?>posts/update/<?php echo $post->id; ?>'>Update</a>
                        <a class="btn btn-red" href='<?php echo constant('URL'); ?>posts/delete/<?php echo $post->id; ?>'>Delete</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>