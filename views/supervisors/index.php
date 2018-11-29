<div>
    <div>
        <a href='<?php echo constant('URL'); ?>supervisors/insert'>Insert supervisor</a>
    </div>

    <p><strong>Listado de los supervisores:</strong></p>
    <table>
        <thead>
            <tr>
                <th>
                    <span>Nom</span>
                    <button name="sort" value="nom:asc">↑</button>
                    <button name="sort" value="nom:desc">↓</button>
                </th>
                <th>
                    <span>Created date</span>
                    <button name="sort" value="created_date:asc">↑</button>
                    <button name="sort" value="created_date:desc">↓</button>
                </th>
                <th>
                    <span>Is boss</span>
                    <button name="sort" value="is_boss:asc">↑</button>
                    <button name="sort" value="is_boss:desc">↓</button>
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
                        <a href='<?php echo constant('URL'); ?>supervisors/show/<?php echo $post->id; ?>'>Read</a>
                        <a href='<?php echo constant('URL'); ?>supervisors/update/<?php echo $post->id; ?>'>Update</a>
                        <a href='<?php echo constant('URL'); ?>supervisors/delete/<?php echo $post->id; ?>'>Delete</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>