<?php
    $dbhost = "localhost";
    $dbchar = "utf8";
    $dbname = "dbname";
    $dbuser = "user";
    $dbpass = "password";
    try {
        $connection = new PDO(
            "mysql:host=".$dbhost.";charset=".$dbchar.";dbname=".$dbname,
            $dbuser, $dbpass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
            ]);
    } catch (Exception $ex) {
      echo json_encode([
        "status" => 0,
        "msg" => $ex->getMessage()
      ]);
      die();
    }
?>