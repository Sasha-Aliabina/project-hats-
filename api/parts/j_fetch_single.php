<?php

include ('conn.php');

    if(isset($_POST["id"])){
        $output = array();
        $statement = $connection->prepare("SELECT * FROM journal WHERE id = '".$_POST["id"]."' LIMIT 1");
        $statement->execute();
        $result = $statement->fetchAll();
 
        foreach($result as $row){
            $output["user_date"] = $row["user_date"];
            $output["content"] = $row["content"];
        }
 
        echo json_encode($output);
    }

?>