<?php

include('conn.php');
include('function.php');

    if(isset($_POST["operation"])){
 
        if($_POST["operation"] == "Add"){
            $photo = '';
            $photo_xs = '';
  
            if($_FILES["photo"]["name"] != '' && $_FILES["photo_xs"]["name"] != ''){
                $photo = upload_image();
                $photo_xs = upload_image_xs();
            }
  
            $statement = $connection->prepare("INSERT INTO gallery (title, content, photo, photo_xs) VALUES (:title, :content, :photo, :photo_xs)");
            $result = $statement->execute(
                array(
                    ':title' => $_POST["title"],
                    ':content' => $_POST["content"],
                    ':photo'  => $photo,
                    ':photo_xs'  => $photo_xs,
                )
            );
        
                if(!empty($result)){
                    echo '<div id="alertInfo" class="alert alert-success" role="alert"><h2 class="alert-heading"><i class="fa fa-check"></i>Обновление прошло успешно</h4>';
                }
        }
 
        if($_POST["operation"] == "Edit"){
            $photo = '';
            $photo_xs = '';
    
            if($_FILES["photo"]["name"] != ''){
                $d_photo = get_image_name($_POST["id"]);
                $del_photo = unlink("./img/" . $d_photo);
                $photo = upload_image();
            
            }else{
                $photo = $_POST["hidden_user_image"];
            }
  
            if($_FILES["photo_xs"]["name"] != ''){
                $d_photo_xs = get_image_name_xs($_POST["id"]);
                $del_photo_xs = unlink("./img/thumbs/" . $d_photo_xs);
                $photo_xs = upload_image_xs();
  
            }else{
   
                $photo_xs = $_POST["hidden_user_image_xs"];
            }
  
            $statement = $connection->prepare("UPDATE gallery SET title = :title, content = :content, photo = :photo, photo_xs = :photo_xs  WHERE id = :id");
            $result = $statement->execute(
                array(
                    ':title' => $_POST["title"],
                    ':content' => $_POST["content"],
                    ':photo'  => $photo,
                    ':photo_xs'  => $photo_xs,
                    ':id'   => $_POST["id"]
                )
            );
        }
    }

?>