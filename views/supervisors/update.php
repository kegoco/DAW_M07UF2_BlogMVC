<div class="container">
    <h1 class="title">Update supervisor #<?php echo $post->id; ?></h1>
    <form action="<?php echo constant('URL'); ?>supervisors/updateSupervisor" method="post" enctype="multipart/form-data">
        <table class="table">
            <input type="hidden" name="id" value="<?php echo $post->id; ?>" readonly>
            <tr>
                <td>
                    <b class="bold">Name:</b>
                </td>
                <td>
                    <input class="input" type="text" name="nom" placeholder="Enter the name..." value="<?php echo $post->nom; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Is boss:</b>
                </td>
                <td>
                    <select class="input" name="is_boss">
                        <option value="true" <?php echo ($post->is_boss == "true") ? "selected" : "" ?>>True</option>
                        <option value="false" <?php echo ($post->is_boss == "false") ? "selected" : "" ?>>False</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="btn btn-green" type="submit" value="Update">
                </td>
            </tr>
        </table>
    </form>
</div>