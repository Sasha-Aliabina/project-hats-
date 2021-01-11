<?php 
	
	function active($currect_page){
		$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
		$url = end($url_array);  
		if($currect_page === $url){
			echo 'active';
		} 
	}
	include 'conn.php';
?>

<script>
    function logout () {
      var data = new FormData();
      data.append('req', 'out');
      var xhr = new XMLHttpRequest();
      xhr.open('POST', "log_in");
      xhr.onload = function () {
        if (xhr.status==200) {
          let response = JSON.parse(this.response);
          if (response.status) {
            window.location.href = "login";
          } else {
            alert(response.msg);
          }
        }
        else {
          alert("Сервер не отвечает");
          console.log(this.response);
        }
      };
      xhr.onerror = function(e){
        alert("Ошибка");
        console.log(e);
      };
      xhr.send(data);
      return false;
    }
</script>

<nav class="navtop">
    	<div>
			<h1><span>П</span>анель администратора</h1>
      <div class="<?php active('home');?>"><a class="<?php active('home');?>" href="home"><i class="fas fa-home"></i><span>Главная страница</span></a></div>
      <div class="<?php active('gallery');?>"><a class="<?php active('gallery');?>" href="gallery"><i class="far fa-images"></i><span>Галерея</span></a></div>
      <div class="<?php active('journal');?>"><a class="<?php active('journal');?>" href="journal"><i class="far fa-newspaper"></i><span>Журнал</span></a></div>
			<div class="<?php active('articles');?>"><a class="<?php active('articles');?>" href="articles"><i class="fas fa-tasks"></i><span>Полезные советы</span></a></div>
		</div>
    <button class="logout_btn" type="reset" onclick="logout()"><i class="fa fa-user-circle" aria-hidden="true"></i> Выход</button>
	</nav>