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

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM SUPERVISOR');

        // creamos una lista de objectos post y recorremos la respuesta de la consulta
        foreach ($req->fetchAll() as $post) {
            $list[] = new Supervisor($post['id'], $post['nom'], $post['created_date'], $post['is_boss']);
        }
        return $list;
    }
}
?>