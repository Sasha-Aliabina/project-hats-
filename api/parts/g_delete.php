<?php

include 'conn.php';
include 'function.php';

if(isset($_POST["id"])){
    $photo = get_image_name($_POST["id"]);
    $photo_xs = get_image_name_xs($_POST["id"]);
        
    if($photo != ''){
        unlink("./img/" . $photo);
    }
    
    if($photo_xs != ''){
        unlink("./img/thumbs/" . $photo_xs);
    }
 
    $statement = $connection->prepare("DELETE FROM gallery WHERE id = :id");
    $result = $statement->execute(
        array(
            ':id' => $_POST["id"]
        )
    );
 
    if(!empty($result)){
        echo 'Фотокарточка удалена!';
    }
}

?>