<DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <header>
            <a href='<?php echo constant('URL'); ?>'>Home</a>
            <a href='<?php echo constant('URL'); ?>posts/index'>Posts</a>
        </header>

        <?php require_once 'routes.php';?>

        <footer>
            Copyright
        </footer>
    </body>
</html>