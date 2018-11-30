<!-- <p><strong>Post #<?php echo $post->id; ?></strong></p>
<p><strong>Title: </strong><?php echo $post->title; ?></p>
<p><strong>Autor: </strong><?php echo $post->author; ?></p>
<p><strong>Post: </strong><?php echo $post->content; ?></p>
<p><strong>Image: </strong><img src="<?php echo constant('URL')."uploads/".$post->image; ?>" width="200"></p>
<p><strong>Created date: </strong><?php echo $post->created_date; ?></p>
<p><strong>Modified date: </strong><?php echo $post->modified_date; ?></p>
<p><strong>Supervisor: </strong><?php echo $post->supervisor_name; ?></p> -->
<div class="container">
    <table class="table">
        <tbody>
            <tr>
                <td>
                    <b class="bold">Post #</b>
                </td>
                <td>
                    <span><?php echo $post->id; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Title:</b>
                </td>
                <td>
                    <span><?php echo $post->title; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Autor:</b>
                </td>
                <td>
                    <span><?php echo $post->author; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Post:</b>
                </td>
                <td>
                    <span><?php echo $post->content; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Image:</b>
                </td>
                <td>
                    <img src="<?php echo constant('URL')."uploads/".$post->image; ?>" width="200">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Created date:</b>
                </td>
                <td>
                    <span><?php echo $post->created_date; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Modified date:</b>
                </td>
                <td>
                    <span><?php echo $post->modified_date; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Supervisor:</b>
                </td>
                <td>
                    <span><?php echo $post->supervisor_name; ?></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>