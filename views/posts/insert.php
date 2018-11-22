<div>
    <h2>Insert a new post</h2>
    <form action="<?php echo constant('URL'); ?>posts/insertNewPost" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <b>Title:</b>
                </td>
                <td>
                    <input type="text" name="title" placeholder="Enter a title...">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Author:</b>
                </td>
                <td>
                    <input type="text" name="author" placeholder="Enter an author...">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Content:</b>
                </td>
                <td>
                    <input type="text" name="content" placeholder="Enter the post content...">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Image:</b>
                </td>
                <td>
                    <input type="file" name="image" />
                </td>
            </tr>
        </table>

        <input type="submit" value="Insert">
    </form>
</div>
