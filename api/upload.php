<?php

	if(empty($_FILES['file'])){
		exit();	
	}

	$errorImgFile = "../uploads/NoImageFound.png";
	$destinationFilePath = '../uploads/'.$_FILES['file']['name'];
	
	if(!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)){
		echo $errorImgFile;

	}else{
		echo $destinationFilePath;
	}

?>