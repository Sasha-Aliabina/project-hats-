<?php

if(isset($_FILES['file']['name'])){

   $filename = $_FILES['file']['name'];

   $location = "../uploads/".$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);
   $name = pathinfo($filename, PATHINFO_FILENAME );

   $valid_extensions = array("jpg","jpeg","png", "pdf", "zip", "gif");

   $response = 0;

   if(in_array(strtolower($imageFileType), $valid_extensions)) {

      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $response = $location;
      }
   }
   echo '<a class="file_download" href="'.$response.'" download>'.$name.'</a>';
   exit;
}

echo 0;