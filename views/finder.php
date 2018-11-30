<?php
// Se abre el formulario y se cerrará en el fichero pagination.php
echo "<div>
        <form action='".constant('URL').$controller."/index' method='POST'>
            <div class='finder-container'>
                <div>
                    <input class='finder-input' type='text' name='filter' placeholder='Search...' value='$filter'>
                    <button class='btn btn-yellowgreen' type='submit'>Search</button>
                    <button class='btn btn-yellowgreen' type='submit' name='filter' value=''>Clear filter</button>
                    <input type='hidden' name='selected_sort' value='$sort' readonly>
                    <input type='hidden' name='selected_page' value='$page' readonly>
                </div>
";
/*
    - El input "selected_sort" guarda la ordenación.
    - El input "selected_page" guarda la página seleccionada.
*/
?>