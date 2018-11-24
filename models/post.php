<?php
class Post
{
    // definimos tres atributos
    // los declaramos como públicos para acceder directamente $post->author
    public $id;
    public $title;
    public $author;
    public $content;
    public $image;
    public $created_date;
    public $modified_date;
    public $supervisor_id;
    public $supervisor_name;
    public function __construct($id, $title, $author, $content, $image, $created_date, $modified_date, $supervisor_id, $supervisor_name)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
        $this->image = $image;
        $this->created_date = $created_date;
        $this->modified_date = $modified_date;
        $this->supervisor_id = $supervisor_id;
        $this->supervisor_name = $supervisor_name;
    }
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT t1.*, t2.nom FROM posts t1 LEFT JOIN SUPERVISOR t2 ON t1.supervisor = t2.id');

        // creamos una lista de objectos post y recorremos la respuesta de la consulta
        foreach ($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['title'], $post['author'], $post['content'], $post['image'], $post['created_date'], $post['modified_date'], $post["supervisor"], $post["nom"]);
        }
        return $list;
    }
    public static function find($id)
    {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $id = intval($id);
        $req = $db->prepare('SELECT t1.*, t2.nom FROM posts t1 LEFT JOIN SUPERVISOR t2 ON t1.supervisor = t2.id WHERE t1.id = :id');
        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->execute(array('id' => $id));
        $post = $req->fetch();
        return new Post($post['id'], $post['title'], $post['author'], $post['content'], $post['image'], $post['created_date'], $post['modified_date'], $post["supervisor"], $post["nom"]);
    }

    public static function insert($title, $author, $content, $image, $created_date, $modified_date, $supervisor) {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO posts SET title = :title, author = :author, content = :content, image = :image, created_date = :created_date, modified_date = :modified_date, supervisor = :supervisor');
        $data = array(
            ":title" => htmlspecialchars(strip_tags($title)),
            ":author" => htmlspecialchars(strip_tags($author)),
            ":content" => htmlspecialchars(strip_tags($content)),
            ":image" => htmlspecialchars(strip_tags($image)),
            ":created_date" => htmlspecialchars(strip_tags($created_date)),
            ":modified_date" => htmlspecialchars(strip_tags($modified_date)),
            ":supervisor" => htmlspecialchars(strip_tags($supervisor))
        );

        if($req->execute($data)){
            // Inserción correcta
            Post::uploadImage($image);
            header('Location: '.constant('URL')."posts/insert/success");
        }else{
            // Error al insertar
            header('Location: '.constant('URL')."posts/insert/error");
        }
    }

    public static function update($id, $title, $author, $content, $image, $modified_date, $supervisor) {
        $db = Db::getInstance();
        if (empty($image)) {
            $req = $db->prepare('UPDATE posts SET title = :title, author = :author, content = :content, modified_date = :modified_date, supervisor = :supervisor WHERE id = :id');
            $data = array(
                ":id" => htmlspecialchars(strip_tags($id)),
                ":title" => htmlspecialchars(strip_tags($title)),
                ":author" => htmlspecialchars(strip_tags($author)),
                ":content" => htmlspecialchars(strip_tags($content)),
                ":modified_date" => htmlspecialchars(strip_tags($modified_date)),
                ":supervisor" => htmlspecialchars(strip_tags($supervisor))
            );
    
            if($req->execute($data)){
                // Actualización correcta
                header('Location: '.constant('URL')."posts/index");
            }else{
                // Error al actualizar
                return call('posts', 'error', "ERROR: This post can't be updated!");
            }
        }
        else {
            $req = $db->prepare('UPDATE posts SET title = :title, author = :author, content = :content, image = :image, modified_date = :modified_date, supervisor = :supervisor WHERE id = :id');
            $data = array(
                ":id" => htmlspecialchars(strip_tags($id)),
                ":title" => htmlspecialchars(strip_tags($title)),
                ":author" => htmlspecialchars(strip_tags($author)),
                ":content" => htmlspecialchars(strip_tags($content)),
                ":image" => htmlspecialchars(strip_tags($image)),
                ":modified_date" => htmlspecialchars(strip_tags($modified_date)),
                ":supervisor" => htmlspecialchars(strip_tags($supervisor))
            );
    
            if($req->execute($data)){
                // Actualización correcta
                Post::uploadImage($image);
                header('Location: '.constant('URL')."posts/index");
            }else{
                // Error al actualizar
                return call('posts', 'error', "ERROR: This post can't be updated!");
            }
        }
    }

    public static function delete($id) {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');
        $data = array(
            ":id" => htmlspecialchars(strip_tags($id))
        );
        return $req->execute($data);
    }

    private static function uploadImage($image) {
        if($image){
    
            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    
            // error message is empty
            $file_upload_error_messages="";

            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }
            
            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
            
            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (1024000)){
                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
    

            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    // $result_message.="<div class='alert alert-danger'>";
                    //     $result_message.="<div>Unable to upload photo.</div>";
                    //     $result_message.="<div>Update the record to upload photo.</div>";
                    // $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                // $result_message.="<div class='alert alert-danger'>";
                //     $result_message.="{$file_upload_error_messages}";
                //     $result_message.="<div>Update the record to upload photo.</div>";
                // $result_message.="</div>";
            }
        }
    }
}
?>