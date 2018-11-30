<div class="container">
    <h1 class="title">Insert a new supervisor</h1>
    <form action="<?php echo constant('URL'); ?>supervisors/insertNewSupervisor" method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>
                    <b class="bold">Name:</b>
                </td>
                <td>
                    <input class="input" type="text" name="nom" placeholder="Enter the supervisor name...">
                </td>
            </tr>
            <tr>
                <td>
                    <b class="bold">Is boss:</b>
                </td>
                <td>
                    <select class="input" name="is_boss">
                        <option value="true">True</option>
                        <option value="false">False</option>
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
