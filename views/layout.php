<!DOCTYPE html>
<html>
    <head>
        <title>Blog MVC - Kevin Gómez Codina</title>

        <!-- ESTILOS -->
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/reset.css">
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/header.css">
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/body.css">
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/footer.css">

        <!-- ICONOS FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>

    <body class="body">
        <header class="header-container">
            <a href='<?php echo constant('URL'); ?>' class="header-link">Home</a>
            <a href='<?php echo constant('URL'); ?>posts/index' class="header-link">Posts</a>
            <a href='<?php echo constant('URL'); ?>supervisors/index' class="header-link">Supervisors</a>
        </header>

        <div class="body-container">
            <?php require_once 'routes.php';?>
        </div>

        <footer class="footer-container content-center">
            <span class="copyRight text-center">Copyright</span>
        </footer>
    </body>
</html>