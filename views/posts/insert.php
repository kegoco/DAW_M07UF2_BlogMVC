<div class="container">
    <h1 class="title">Insert a new post</h1>
    <form action="<?php echo constant('URL'); ?>posts/insertNewPost" method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>
                    <b class="bold">Title:</b>
                </td>
                <td>
                    <input class="input" type="text" name="title" placeholder="Enter a title...">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Author:</b>
                </td>
                <td>
                    <input class="input" type="text" name="author" placeholder="Enter an author...">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Content:</b>
                </td>
                <td>
                    <input class="input" type="text" name="content" placeholder="Enter the post content...">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Image:</b>
                </td>
                <td>
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
                                echo "<option value='".$supervisors[$i]->id."'>".$supervisors[$i]->nom."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="btn btn-green" type="submit" value="Insert">
                </td>
            </tr>
        </table>
    </form>
</div>
