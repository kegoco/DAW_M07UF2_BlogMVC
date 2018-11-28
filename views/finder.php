<?php
// Se abre el formulario y se cerrará en el fichero pagination.php
echo "<div>
        <form action='".constant('URL').$controller."/index' method='POST'>
            <input type='text' name='filter' placeholder='Search...' value='$filter'>
            <button type='submit'>Search</button>
            <button type='submit' name='filter' value=''>Clear filter</button>
";
?>