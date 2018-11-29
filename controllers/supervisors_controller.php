<?php
class SupervisorsController
{
    /* Retorna la página con todos los supervisores */
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
            // Si es así crea la instrucción "ORDER BY" para pasársela a la consulta de buscar los supervisores
            $sort_array = explode(":", $sort);
            $sort = "ORDER BY ".$sort_array[0]." ".$sort_array[1];
        }
        else if (isset($_POST["selected_sort"])) {
            // Si ya se ha seleccionado una ordenación anteriormente la mantiene
            // (esto interesa tenerlo para cuando el usuario haga el cambio de página)
            $sort = $_POST["selected_sort"];
        }

        $controller = "supervisors";  // Indica en qué controlador estamos
        $count_posts = Supervisor::countAll($filter);  // Hace el count para la paginación
        $pagination = new PaginationController((!empty($page)) ? $page : 1, $count_posts);
        $posts = Supervisor::all($pagination->items_show, $pagination->items_page, $filter, $sort);  // Guardamos todos los supervisores en una variable
        require_once 'views/finder.php';
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