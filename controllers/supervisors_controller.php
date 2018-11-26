<?php
class SupervisorsController
{
    public function index($page)
    {
        $controller = "supervisors";
        $count_posts = Supervisor::countAll();
        $pagination = new PaginationController((!empty($page)) ? $page : 1, $count_posts);
        $posts = Supervisor::all($pagination->items_show, $pagination->items_page);  // Guardamos todos los posts en una variable
        require_once 'views/supervisors/index.php';
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

    public function insert($message) {
        if ($message == "success") {
            // Muestra un mensaje indicando que el supervisor se ha creado correctamente
            echo "
                <div>
                    <b>Success: The supervisor was created successfully!</b>
                </div>
            ";
        }
        else if ($message == "error") {
            // Muestra un mensaje indicando que el supervisor no se ha podido crear
            echo "
                <div>
                    <b>Error: The supervisor hasn't been created!</b>
                </div>
            ";
        }

        require_once 'views/supervisors/insert.php';
    }

    public function insertNewSupervisor() {
        $nom = $_POST["nom"];
        $is_boss = $_POST["is_boss"];
        $created_date = date('Y-m-d H:i:s');

        if ($this->hasNulls([$nom, $is_boss])) {
            // Hay algún campo que es null, así que se lanza un error
            header('Location: '.constant('URL')."supervisors/insert/error");
        }
        else {
            // Los campos tienen datos, por lo tanto se ejecuta el insert
            Supervisor::insert($nom, $is_boss, $created_date);
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

        require_once 'views/supervisors/error.php';
    }
}
?>