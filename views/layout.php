<!DOCTYPE html>
<html>
    <head>
        <title>Blog MVC - Kevin Gómez Codina</title>

        <!-- ESTILOS -->
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/reset.css">
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/header.css">
    </head>

    <body>
        <header class="header-container">
            <a href='<?php echo constant('URL'); ?>' class="header-link">Home</a>
            <a href='<?php echo constant('URL'); ?>posts/index' class="header-link">Posts</a>
            <a href='<?php echo constant('URL'); ?>supervisors/index' class="header-link">Supervisors</a>
        </header>

        <?php require_once 'routes.php';?>

        <footer>
            Copyright
        </footer>
    </body>
</html>