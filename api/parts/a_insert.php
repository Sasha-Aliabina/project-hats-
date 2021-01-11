<?php

include('conn.php');

    if(isset($_POST["operation"])){
 
        if($_POST["operation"] == "Add"){
  
            $statement = $connection->prepare("INSERT INTO usefultips (title, content) VALUES (:title, :content)");
            $result = $statement->execute(
                array(
                    ':title' => $_POST["title"],
                    ':content' => $_POST["content"],
                )
            );
        }
 
        if($_POST["operation"] == "Edit"){
  
            $statement = $connection->prepare("UPDATE usefultips SET title = :title, content = :content  WHERE id = :id");
            $result = $statement->execute(
                array(
                    ':title' => $_POST["title"],
                    ':content' => $_POST["content"],
                    ':id'   => $_POST["id"]
                )
            );
        }
    }

?>