<div>
    <ul>
        <?php
        foreach ($pages as $page) {
            echo "<li><a href='".constant('URL')."$controller/index/$page'>$page</a></li>";
        }
        ?>
    </ul>
</div>