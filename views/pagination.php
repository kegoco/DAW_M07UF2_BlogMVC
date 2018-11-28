<div>
    <ul>
        <li><a href="<?php echo constant('URL').$controller; ?>/index/1">First</a></li>
        <?php
        foreach ($pages as $page) {
            echo "<li><a href='".constant('URL')."$controller/index/$page'>$page</a></li>";
        }
        ?>
        <li><a href="<?php echo constant('URL').$controller; ?>/index/<?php echo count($pages); ?>">Last</a></li>
    </ul>
</div>