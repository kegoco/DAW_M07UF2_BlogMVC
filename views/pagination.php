<div>
    <ul>
        <li><button type='submit' name='page' value='1'>First</button></li>
        <?php
        foreach ($pages as $page) {
            // echo "<li><a href='".constant('URL')."$controller/index/$page'>$page</a></li>";
            echo "<li><input type='submit' name='page' value='$page'></li>";
        }
        ?>
        <li><button type='submit' name='page' value='<?php echo count($pages); ?>'>Last</button></li>
    </ul>
</div>

<?php
// Cierra el formulario y el div que se abren en el fichero filter.php
echo "</form>
    </div>
";
?>