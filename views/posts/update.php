<div class="container">
    <h1 class="title">Update post #<?php echo $post->id; ?></h1>
    <form action="<?php echo constant('URL'); ?>posts/updatePost" method="post" enctype="multipart/form-data">
        <table class="table">
            <input type="hidden" name="id" value="<?php echo $post->id; ?>" readonly>
            <tr>
                <td>
                    <b class="bold">Title:</b>
                </td>
                <td>
                    <input class="input" type="text" name="title" placeholder="Enter a title..." value="<?php echo $post->title; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Author:</b>
                </td>
                <td>
                    <input class="input" type="text" name="author" placeholder="Enter an author..." value="<?php echo $post->author; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Content:</b>
                </td>
                <td>
                    <input class="input" type="text" name="content" placeholder="Enter the post content..." value="<?php echo $post->content; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Image:</b>
                </td>
                <td>
                    <img src='<?php echo constant('URL')."uploads/".$post->image; ?>' width="200" />
                    <input class="input" type="file" name="image" />
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Supervisor:</b>
                </td>
                <td>
                    <select class="input" name="supervisor">
                        <?php 
                            $supervisors = Supervisor::all(null, null, "", "");
                            for ($i = 0; $i < count($supervisors); $i++) {
                                echo "<option value='".$supervisors[$i]->id."' ".(($supervisors[$i]->id == $post->supervisor_id) ? "selected" : "").">".$supervisors[$i]->nom."</option>";
                            }
                        ?>
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