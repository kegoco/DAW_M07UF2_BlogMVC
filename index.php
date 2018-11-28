<?php
    //K require_once 'connection.php';
    // if (isset($_GET['controller']) && isset($_GET['action'])) {
    //E     $controller = $_GET['controller'];
    //     $action = $_GET['action'];
    //V } else {
    //     $controller = 'pages';
    //I     $action = 'home';
    // }
    //N require_once 'views/layout.php';

    require_once 'connection.php';

    define('URL', 'http://localhost/DAW_M07UF2_BlogMVC_KGC/');

    if(isset($_GET['url'])){
        $url = $_GET['url']; // 'posts/index'
        // Quita / innecesarias a la derecha.
        $url = rtrim($url, '/');
       
        // Devuelve un array utilizando la / como delimitador.
        $url = explode('/', $url); // ['posts', 'index']

        $controller = $url[0];
        $action = $url[1];
        $params = (!empty($url[2])) ? $url[2] : null;
    }
    else {
        $controller = 'pages';
        $action = 'home';
        $params = null;
    }
    
    require_once 'views/layout.php';
?>