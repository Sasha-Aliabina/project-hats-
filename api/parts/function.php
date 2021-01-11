<?php
    function upload_image(){
        
        if(isset($_FILES["photo"])){
            $extension = explode('.', $_FILES['photo']['name']);
            $new_name = time() . '.' . $extension[1];
            $destination = './img/' . $new_name;
        
            move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
            return $new_name;
        }
    }

    function get_image_name($id){
 
        include('conn.php');
 
        $statement = $connection->prepare("SELECT photo FROM gallery WHERE id = '$id'");
        $statement->execute();
        $result = $statement->fetchAll();
 
           foreach($result as $row){
                return $row["photo"];
            }
        }

    function upload_image_xs(){
 
        if(isset($_FILES["photo_xs"])){
  
            $extension = explode('.', $_FILES['photo_xs']['name']);
            $new_name_xs = time() . '.' . $extension[1];
            $destination = './img/thumbs/' . $new_name_xs;
  
            move_uploaded_file($_FILES['photo_xs']['tmp_name'], $destination);
            return $new_name_xs;
        }
    }

    function get_image_name_xs($id){
 
        include('conn.php');
 
        $statement = $connection->prepare("SELECT photo_xs FROM gallery WHERE id = '$id'");
        $statement->execute();
        $result = $statement->fetchAll();
 
            foreach($result as $row){
                return $row["photo_xs"];
            }
    }

    function get_total_all_records(){
 
        include('conn.php');
 
        $statement = $connection->prepare("SELECT * FROM gallery");
        $statement->execute();
        $result = $statement->fetchAll();
        return $statement->rowCount();
    }
    
    function get_total_all_records_journal(){
 
        include('conn.php');
 
        $statement = $connection->prepare("SELECT * FROM journal");
        $statement->execute();
        $result = $statement->fetchAll();
        return $statement->rowCount();
    }

    function get_total_all_records_articles(){
 
        include('conn.php');
 
        $statement = $connection->prepare("SELECT * FROM usefultips");
        $statement->execute();
        $result = $statement->fetchAll();
        return $statement->rowCount();
    }

?>