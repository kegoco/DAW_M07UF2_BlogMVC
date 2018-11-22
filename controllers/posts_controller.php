<?php
class PostsController
{
    public function index()
    {
        // Guardamos todos los posts en una variable
        $posts = Post::all();
        require_once 'views/posts/index.php';
    }
    public function show($id)
    {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id tenemos que buscarloen la BBDD
        if (empty($id)) {
            return call('pages', 'error', null);
        }
        // utilizamos el id para obtener el post correspondiente
        $post = Post::find($id);
        require_once 'views/posts/show.php';
    }

    /* Devuelve la vista de insertar post */
    public function insert() {
        require_once 'views/posts/insert.php';
    }

    public function insertNewPost() {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $content = $_POST["content"];
        // $image = $_POST["image"];
        $image=!empty($_FILES["image"]["name"])
            ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
        $created_date = date('Y-m-d H:i:s');
        $modified_date = date('Y-m-d H:i:s');

        Post::insert($title, $author, $content, $image, $created_date, $modified_date);
    }
}
?>