<div>
    <h2>Insert a new post</h2>
    <form action="<?php echo constant('URL'); ?>posts/updatePost" method="post" enctype="multipart/form-data">
        <table>
            <input type="hidden" name="id" value="<?php echo $post->id; ?>" readonly>
            <tr>
                <td>
                    <b>Title:</b>
                </td>
                <td>
                    <input type="text" name="title" placeholder="Enter a title..." value="<?php echo $post->title; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Author:</b>
                </td>
                <td>
                    <input type="text" name="author" placeholder="Enter an author..." value="<?php echo $post->author; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Content:</b>
                </td>
                <td>
                    <input type="text" name="content" placeholder="Enter the post content..." value="<?php echo $post->content; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Image:</b>
                </td>
                <td>
                    <img src='<?php echo constant('URL')."uploads/".$post->image; ?>' style='width:300px;' />
                    <input type="file" name="image" />
                </td>
            </tr>
            <tr>
                <td>
                    <b>Supervisor:</b>
                </td>
                <td>
                    <select name="supervisor">
                        <?php 
                            $supervisors = Supervisor::all();
                            for ($i = 0; $i < count($supervisors); $i++) {
                                echo "<option value='".$supervisors[$i]->id."' ".(($supervisors[$i]->id == $post->id) ? "selected" : "").">".$supervisors[$i]->nom."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" value="Update">
    </form>
</div>