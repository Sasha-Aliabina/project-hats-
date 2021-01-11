<?php
session_start();
if (isset($_SESSION['user'])) {
	header("Location: articles");
	die();
}
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Панель администратора</title>
	<link href="..//img/icon.png" rel="icon" sizes="any" type="image/png">
  <link href="./css/style_admin.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=PT+Serif&display=swap" rel="stylesheet">

<script>
    function login () {
      var data = new FormData();
      data.append('req', 'in');
      data.append('login', document.getElementById("ulogin").value);
      data.append('password', document.getElementById("upass").value);

      // Login
      var xhr = new XMLHttpRequest();
      xhr.open('POST', "log_in");

      // Server response
      xhr.onload = function () {
        if (xhr.status==200) {
          let response = JSON.parse(this.response);
          if (response.status) {
            window.location.href = "home";
          } else {
            alert(response.msg);
          }
        }
        // Server responses "not ok"
        // (404, 403, etc)
        else {
          alert("Сервер не отвечает");
          console.log(this.response);
        }
      };

      // Server didn't respond
      xhr.onerror = function(e){
        alert("Ошибка");
        console.log(e);
      };

      // Send a request
      xhr.send(data);
      return false;
    }
    </script>
  </head>
  <body class="body_login">
  <div class="div_login">
    <form id="login" onsubmit="return login();">
      <h2>Авторизация</h2>
      <input type="text" id="ulogin" placeholder="Логин" required>
      <input type="password" id="upass" placeholder="Пароль" required>
      <input type="submit" id="ugo" value="Войти">
    </form>
    </div>
  </body>
</html>