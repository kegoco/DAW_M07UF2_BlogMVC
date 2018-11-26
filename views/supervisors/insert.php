<div>
    <h2>Insert a new supervisor</h2>
    <form action="<?php echo constant('URL'); ?>supervisors/insertNewSupervisor" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <b>Name:</b>
                </td>
                <td>
                    <input type="text" name="nom" placeholder="Enter the supervisor name...">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Is boss:</b>
                </td>
                <td>
                    <select name="is_boss">
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" value="Insert">
    </form>
</div>
