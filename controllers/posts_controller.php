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
            // Muestra un mensaje indicando que el post se ha creado correctamente
            echo "
                <div>
                    <b>Success: The post was created successfully!</b>
                </div>
            ";
        }
        else if ($message == "error") {
            // Muestra un mensaje indicando que el post no se ha podido crear
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
        $supervisor = $_POST["supervisor"];

        if ($this->hasNulls([$title, $author, $content, $image, $created_date, $modified_date, $supervisor])) {
            // Hay algún campo que es null, así que se lanza un error
            header('Location: '.constant('URL')."posts/insert/error");
        }
        else {
            // Los campos tienen datos, por lo tanto se ejecuta el insert
            Post::insert($title, $author, $content, $image, $created_date, $modified_date, $supervisor);
        }
    }

    /* Devuelve la vista de modificar un post */
    public function update($id) {
        if (empty($id)) {
            return call('posts', 'error', "ERROR: No post selected!");
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
            ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : null;
        $modified_date = date('Y-m-d H:i:s');
        $supervisor = $_POST["supervisor"];

        if ($this->hasNulls([$id, $title, $author, $content, $modified_date, $supervisor])) {
            // Hay algún campo que es null, así que se lanza un error
            return call('posts', 'error', "ERROR: You need to specify all values!");
        }
        else {
            // Los campos tienen datos, por lo tanto se ejecuta el insert
            Post::update($id, $title, $author, $content, $image, $modified_date, $supervisor);
        }
    }

    /* Borra el post especificado */
    public function delete($id) {
        if (empty($id)) {
            return call('posts', 'error', "ERROR: This post hasn't exists!");
        }

        if (Post::delete($id)) {
            header('Location: '.constant('URL')."posts/index");  // Retorna al índice de posts
        }
        else {
            // No se ha podido borrar, retorna error
            return call('posts', 'error', "ERROR: This post can't be delete!");
        }
    }

    /* Comprueba si el parámetro es null */
    private function hasNulls($request) {
        return in_array(null, $request) || in_array("", $request);
    }

    /* Retorna la vista de error de los posts */
    public function error($message) {
        if ($message) {
            echo "
                <div>
                    <b>$message</b>
                </div>
            ";
        }

        require_once 'views/posts/error.php';
    }
}
?>