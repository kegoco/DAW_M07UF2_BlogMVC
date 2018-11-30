<!-- <p><strong>Supervisor #<?php echo $post->id; ?></strong></p>
<p><strong>Name: </strong><?php echo $post->nom; ?></p>
<p><strong>Is boss: </strong><?php echo $post->is_boss; ?></p> -->
<div class="container">
    <table class="table">
        <tbody>
            <tr>
                <td>
                    <b class="bold">Supervisor #</b>
                </td>
                <td>
                    <span><?php echo $post->id; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Name:</b>
                </td>
                <td>
                    <span><?php echo $post->nom; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Is boss:</b>
                </td>
                <td>
                    <span><?php echo $post->is_boss; ?></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>