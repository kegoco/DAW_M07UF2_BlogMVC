<?php
function call($controller, $action, $params)
{
    require_once 'controllers/' . $controller . '_controller.php';
    switch ($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'posts':
            // necesitamos el modelo para después consultar a la BBDD desde el controlador
            require_once 'models/post.php';
            $controller = new PostsController();
            break;
    }
    $controller->{$action}($params);
}
// agregando una entrada para el nuevo controlador y sus acciones.
$controllers = array('pages' => ['home', 'error'],
    'posts' => ['index', 'show', "insert", "insertNewPost", "update"],
);
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action, $params);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}
?>