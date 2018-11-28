<?php
class Supervisor {
    public $id;
    public $nom;
    public $created_date;
    public $is_boss;

    public function __construct($id, $nom, $created_date, $is_boss)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->created_date = $created_date;
        $this->is_boss = $is_boss;
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM SUPERVISOR WHERE id = :id');
        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->execute(array('id' => $id));
        $post = $req->fetch();
        return new Supervisor($post['id'], $post['nom'], $post['created_date'], $post['is_boss']);
    }

    public static function all($offset, $limit) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM SUPERVISOR LIMIT $offset, $limit");

        // creamos una lista de objectos post y recorremos la respuesta de la consulta
        foreach ($req->fetchAll() as $post) {
            $list[] = new Supervisor($post['id'], $post['nom'], $post['created_date'], $post['is_boss']);
        }
        return $list;
    }

    public static function countAll() {
        $db = Db::getInstance();
        $req = $db->query("SELECT COUNT(*) as counter FROM SUPERVISOR");
        return $req->fetchAll()[0]["counter"];
    }

    public static function insert($nom, $is_boss, $created_date) {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO SUPERVISOR SET nom = :nom, created_date = :created_date, is_boss = :is_boss');
        $data = array(
            ":nom" => htmlspecialchars(strip_tags($nom)),
            ":created_date" => htmlspecialchars(strip_tags($created_date)),
            ":is_boss" => htmlspecialchars(strip_tags($is_boss))
        );

        if($req->execute($data)){
            // Inserción correcta
            header('Location: '.constant('URL')."supervisors/insert/success");
        }else{
            // Error al insertar
            header('Location: '.constant('URL')."supervisors/insert/error");
        }
    }

    public static function update($id, $nom, $is_boss) {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE SUPERVISOR SET nom = :nom, is_boss = :is_boss WHERE id = :id');
        $data = array(
            ":nom" => htmlspecialchars(strip_tags($nom)),
            ":is_boss" => htmlspecialchars(strip_tags($is_boss)),
            ":id" => htmlspecialchars(strip_tags($id))
        );

        if($req->execute($data)){
            // Modificación correcta
            header('Location: '.constant('URL')."supervisors/index");
        }else{
            // Error al modificar
            return call('supervisors', 'error', "ERROR: This supervisor can't be updated!");
        }
    }

    public function delete($id) {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM SUPERVISOR WHERE id = :id');
        $data = array(
            ":id" => htmlspecialchars(strip_tags($id))
        );
        return $req->execute($data);
    }
}
?>