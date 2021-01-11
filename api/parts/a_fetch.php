<?php

include('conn.php');
include('function.php');

$query = '';
$output = array();
$query .= "SELECT * FROM usefultips ";

    if(isset($_POST["search"]["value"])){
        $query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" ';
        $query .= 'OR content LIKE "%'.$_POST["search"]["value"].'%" ';
    }

        if(isset($_POST["order"])){
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        
        }else{
            $query .= 'ORDER BY id DESC ';
        }
        
            if($_POST["length"] != -1){
                $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
            }

    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $data = array();
    $filtered_rows = $statement->rowCount();
    
        foreach($result as $row){

            $sub_array = array();
            $sub_array[] = $row["title"];
            $sub_array[] = $row["content"];
            $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="bttn update edit"><i class="fas fa-pencil-alt"></i></button><button type="button" name="delete" id="'.$row["id"].'" class="bttn delete trash"><i class="fas fa-trash-alt"></i></button>';
            $data[] = $sub_array;
        }
    
    $output = array (
        "draw" => intval($_POST["draw"]),
        "recordsTotal"  =>  $filtered_rows,
        "recordsFiltered" => get_total_all_records_articles(),
        "data" => $data
    );
    
    echo json_encode($output);
?>