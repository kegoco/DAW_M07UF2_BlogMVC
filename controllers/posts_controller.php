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
    public function insert($message) {
        if ($message == "success") {
            echo "
                <div>
                    <b>Success: The post was created successfully!</b>
                </div>
            ";
        }
        else if ($message == "error") {
            echo "
                <div>
                    <b>Error: The post hasn't been created!</b>
                </div>
            ";
        }

        require_once 'views/posts/insert.php';
    }

    /* Inserta un nuevo post en la base de datos */
    public function insertNewPost() {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $content = $_POST["content"];
        $image=!empty($_FILES["image"]["name"])
            ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
        $created_date = date('Y-m-d H:i:s');
        $modified_date = date('Y-m-d H:i:s');

        if ($this->hasNulls([$title, $author, $content, $image, $created_date, $modified_date])) {
            // Hay algún campo que es null, así que se lanza un error
            header('Location: '.constant('URL')."posts/insert/error");
        }
        else {
            // Los campos tienen datos, por lo tanto se ejecuta el insert
            Post::insert($title, $author, $content, $image, $created_date, $modified_date);
        }
    }

    /* Devuelve la vista de modificar un post */
    public function update($id) {
        if (empty($id)) {
            return call('posts', 'error', null);
        }
        
        $post = Post::find($id);
        require_once 'views/posts/update.php';
    }
    
    /* Modifica un post en específico */
    public function updatePost() {
        $id = $_POST["id"];
        $title = $_POST["title"];
        $author = $_POST["author"];
        $content = $_POST["content"];
        $image=!empty($_FILES["image"]["name"])
            ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
        $modified_date = date('Y-m-d H:i:s');

        if ($this->hasNulls([$id, $title, $author, $content, $image, $modified_date])) {
            // Hay algún campo que es null, así que se lanza un error
            return call('posts', 'error', null);
        }
        else {
            // Los campos tienen datos, por lo tanto se ejecuta el insert
            Post::update($id, $title, $author, $content, $image, $modified_date);
        }
    }

    /* Borra el post especificado */
    public function delete($id) {
        if (empty($id)) {
            return call('posts', 'error', null);
        }

        if (Post::delete($id)) {
            header('Location: '.constant('URL')."posts/index");
        }
        else {
            return call('posts', 'error', null);
        }
    }

    private function hasNulls($request) {
        return in_array(null, $request) || in_array("", $request);
    }

    public function error() {
        require_once 'views/posts/error.php';
    }
}
?>