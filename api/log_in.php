<?php
session_start();

switch ($_POST['req']) {
  default:
    echo json_encode([
      "status" => 0,
      "msg" => "Неверный запрос"
    ]);
    break;

  case "in":
    // Sign in
    if (isset($_SESSION['user'])) {
      echo json_encode([
        "status" => 1,
        "msg" => "Успешный вход"
      ]);
      die();
    }

    // Connect db
    $dbhost = "localhost";
    $dbchar = "utf8";
    $dbname = "dbname";
    $dbuser = "user";
    $dbpass = "password";
    try {
      $pdo = new PDO(
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

    // Get users
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `user_login`=?");
    $log = htmlentities($_POST['login']);
    $stmt->execute([$log]);
    $user = $stmt->fetch();
    if (!is_array($user)) {
      echo json_encode([
        "status" => 0,
        "msg" => "Неправильный логин или пароль."
      ]);
      die();
    }

    $pass = htmlentities($_POST['password']);

    if (password_verify ($pass, $user['user_password'])) {
      $_SESSION['user'] = [
        "name" => $user['user_name'],
        "login" => $user['user_login']
      ];
      echo json_encode([
        "status" => 1,
        "msg" => "Ок"
      ]);
    } else {
      echo json_encode([
        "status" => 0,
        "msg" => "Неправильный логин или пароль."
      ]);
    }
    die();
    break;

  // Sign out
  case "out":
    unset ($_SESSION['user']);
    echo json_encode([
      "status" => 1,
      "msg" => "Ок"
    ]);
    break;
}