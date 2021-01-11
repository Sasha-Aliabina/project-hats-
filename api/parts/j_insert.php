<?php

include('conn.php');

    if(isset($_POST["operation"])){
 
        if($_POST["operation"] == "Add"){
  
            $statement = $connection->prepare("INSERT INTO journal (user_date, content) VALUES (:user_date, :content)");
            $result = $statement->execute(
                array(
                    ':user_date' => $_POST["user_date"],
                    ':content' => $_POST["content"],
                )
            );
        }
 
        if($_POST["operation"] == "Edit"){
  
            $statement = $connection->prepare("UPDATE journal SET user_date = :user_date, content = :content  WHERE id = :id");
            $result = $statement->execute(
                array(
                    ':user_date' => $_POST["user_date"],
                    ':content' => $_POST["content"],
                    ':id'   => $_POST["id"]
                )
            );
        }
    }

?>