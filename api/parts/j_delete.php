<?php

include 'conn.php';

if(isset($_POST["id"])){
 
    $statement = $connection->prepare("DELETE FROM journal WHERE id = :id");
    $result = $statement->execute(
        array(
            ':id' => $_POST["id"]
        )
    );
 
    if(!empty($result)){
        echo 'Статья удалена!';
    }
}

?>