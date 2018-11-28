<div>
    <h2>Insert a new supervisor</h2>
    <form action="<?php echo constant('URL'); ?>supervisors/updateSupervisor" method="post" enctype="multipart/form-data">
        <table>
            <input type="hidden" name="id" value="<?php echo $post->id; ?>" readonly>
            <tr>
                <td>
                    <b>Name:</b>
                </td>
                <td>
                    <input type="text" name="nom" placeholder="Enter the name..." value="<?php echo $post->nom; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Is boss:</b>
                </td>
                <td>
                    <select name="is_boss">
                        <option value="true" <?php echo ($post->is_boss == "true") ? "selected" : "" ?>>True</option>
                        <option value="false" <?php echo ($post->is_boss == "false") ? "selected" : "" ?>>False</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" value="Update">
    </form>
</div>