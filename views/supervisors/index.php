<div>
    <div>
        <a href='<?php echo constant('URL'); ?>supervisors/insert'>Insert supervisor</a>
    </div>

    <p><strong>Listado de los supervisores:</strong></p>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Created date</th>
                <th>Is boss</th>
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