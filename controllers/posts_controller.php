<?php
class PostsController
{
    public function index()
    {
        $page = 1;
        if (isset($_POST["page"])) {
            $page = $_POST["page"];  // Coge la nueva página seleccionada por el usuario
        }
        else if (isset($_POST["selected_page"])) {
            // Si ya se había seleccionado una página anteriormente la carga:
            $page = $_POST["selected_page"];
        }
        $filter = (isset($_POST["filter"])) ? $_POST["filter"] : "";  // Carga el filtro, si existe
        
        // Comprueba si el usuario ha ordenado la tabla por algún campo:
        $sort = (isset($_POST["sort"])) ? $_POST["sort"] : "";
        if (!empty($sort)) {
            // Si es así crea la instrucción "ORDER BY" para pasársela a la consulta de buscar los posts
            $sort_array = explode(":", $sort);
            $sort = "ORDER BY ".$sort_array[0]." ".$sort_array[1];
        }
        else if (isset($_POST["selected_sort"])) {
            // Si ya se ha seleccionado una ordenación anteriormente la mantiene
            // (esto interesa tenerlo para cuando el usuario haga el cambio de página)
            $sort = $_POST["selected_sort"];
        }

        $controller = "posts";  // Indica en qué controlador estamos
        $count_posts = Post::countAll($filter);  // Hace el count para la paginación
        $pagination = new PaginationController((!empty($page)) ? $page : 1, $count_posts);
        $posts = Post::all($pagination->items_show, $pagination->items_page, $filter, $sort);  // Guardamos todos los posts en una variable
        require_once 'views/finder.php';
        require_once 'views/posts/index.php';
        $pagination->createPagination($controller, $pagination->pages);  // Muestra la paginación
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
                    <b class='success-message'>Success: The post was created successfully!</b>
                </div>
            ";
        }
        else if ($message == "error") {
            // Muestra un mensaje indicando que el post no se ha podido crear
            echo "
                <div>
                    <b class='warning-message'>Error: The post hasn't been created!</b>
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
            // Los campos tienen datos, por lo tanto se ejecuta el update
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