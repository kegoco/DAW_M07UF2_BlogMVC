<?php
class SupervisorsController
{
    /* Retorna la página con todos los supervisores */
    public function index($page)
    {
        $controller = "supervisors";
        $count_posts = Supervisor::countAll();
        $pagination = new PaginationController((!empty($page)) ? $page : 1, $count_posts);
        $posts = Supervisor::all($pagination->items_show, $pagination->items_page);  // Guardamos todos los posts en una variable
        require_once 'views/supervisors/index.php';
        $pagination->createPagination($controller, $pagination->pages);  // Muestra la paginación
    }

    /* Retorna la página con un supervisor */
    public function show($id)
    {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id tenemos que buscarloen la BBDD
        if (empty($id)) {
            return call('supervisors', 'error', "ERROR: No supervisor selected!");
        }
        // utilizamos el id para obtener el post correspondiente
        $post = Supervisor::find($id);
        require_once 'views/supervisors/show.php';
    }

    /* Retorna la vista de insertar supervisor y muestra un mensaje en caso de que se ejecute el insert */
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

    /* Inserta un nuevo supervisor */
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

    /* Retorna la vista para actualizar un supervisor, o mostrará un error en caso de que el supervisor no exista */
    public function update($id) {
        if (empty($id)) {
            return call('supervisors', 'error', "ERROR: No supervisor selected!");
        }
        
        $post = Supervisor::find($id);
        require_once 'views/supervisors/update.php';
    }

    /* Modifica un supervisor  */
    public function updateSupervisor() {
        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $is_boss = $_POST["is_boss"];

        if ($this->hasNulls([$id, $nom, $is_boss])) {
            // Hay algún campo que es null, así que se lanza un error
            return call('supervisors', 'error', "ERROR: You need to specify all values!");
        }
        else {
            // Los campos tienen datos, por lo tanto se ejecuta el update
            Supervisor::update($id, $nom, $is_boss);
        }
    }

    /* Elimina un supervisor */
    public function delete($id) {
        if (empty($id)) {
            return call('supervisors', 'error', "ERROR: This supervisor hasn't exists!");
        }

        if (Supervisor::delete($id)) {
            header('Location: '.constant('URL')."supervisors/index");  // Retorna al índice de posts
        }
        else {
            // No se ha podido borrar, retorna error
            return call('supervisors', 'error', "ERROR: This supervisor can't be delete!");
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