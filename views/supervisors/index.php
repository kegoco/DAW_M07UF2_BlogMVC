<div class="content-right">
    <a class="btn btn-yellowgreen" href='<?php echo constant('URL'); ?>supervisors/insert'>Insert supervisor</a>
</div>

<?php echo "</div>" ?>  <!-- Cierra un div que se abre en el finder.php -->

<div class="container">
    <h1 class="title">Listado de los supervisores</h1>
    <table class="table">
        <thead>
            <tr>
                <th>
                    <span>Nom</span>
                    <button class="sort-icon" name="sort" value="nom:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="nom:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    <span>Created date</span>
                    <button class="sort-icon" name="sort" value="created_date:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="created_date:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    <span>Is boss</span>
                    <button class="sort-icon" name="sort" value="is_boss:asc"><i class="fas fa-arrow-circle-up"></i></button>
                    <button class="sort-icon" name="sort" value="is_boss:desc"><i class="fas fa-arrow-circle-down"></i></button>
                </th>
                <th>
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) {?>
                <tr>
                    <td><?php echo $post->nom; ?></td>
                    <td><?php echo $post->created_date; ?></td>
                    <td><?php echo $post->is_boss; ?></td>
                    <td>
                        <a class="btn btn-blue" href='<?php echo constant('URL'); ?>supervisors/show/<?php echo $post->id; ?>'>Read</a>
                        <a class="btn btn-green" href='<?php echo constant('URL'); ?>supervisors/update/<?php echo $post->id; ?>'>Update</a>
                        <a class="btn btn-red" href='<?php echo constant('URL'); ?>supervisors/delete/<?php echo $post->id; ?>'>Delete</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>