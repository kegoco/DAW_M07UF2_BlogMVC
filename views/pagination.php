<div class="container">
    <ul class="pagination">
        <?php
        $count_pages = count($pages);

        if ($count_pages > 1) echo "<li><button class='pagination-button' type='submit' name='page' value='1'>First</button></li>";
       
        foreach ($pages as $p) {
            // echo "<li><a href='".constant('URL')."$controller/index/$page'>$page</a></li>";
            echo "<li><input class='pagination-button' type='submit' name='page' value='$p'></li>";
        }

        if ($count_pages > 1) echo "<li><button class='pagination-button' type='submit' name='page' value='$count_pages'>Last</button></li>";
        ?>
    </ul>
</div>

<?php
// Cierra el formulario y el div que se abren en el fichero filter.php
echo "</form>
    </div>
";
?>