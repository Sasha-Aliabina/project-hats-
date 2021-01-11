<?php

include ('conn.php');
include ('function.php');

    if(isset($_POST["id"])){
        $output = array();
        $statement = $connection->prepare("SELECT * FROM gallery WHERE id = '".$_POST["id"]."' LIMIT 1");
        $statement->execute();
        $result = $statement->fetchAll();
 
        foreach($result as $row){
            $output["title"] = $row["title"];
            $output["content"] = $row["content"];
  
            if($row["photo"] != ''){
                $output['photo'] = '<img src="./img/'.$row["photo"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["photo"].'" />';
  
            }else{
                $output['photo'] = '<input type="hidden" name="hidden_user_image" value="" />';
            }
  
            if($row["photo_xs"] != ''){
                $output['photo_xs'] = '<img src="./img/thumbs/'.$row["photo_xs"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image_xs" value="'.$row["photo_xs"].'" />';
            
            }else{
                $output['photo_xs'] = '<input type="hidden" name="hidden_user_image_xs" value="" />';
            }
        }
 
        echo json_encode($output);
    }

?>