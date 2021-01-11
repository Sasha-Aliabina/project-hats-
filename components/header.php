<?php 

  function active($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($currect_page === $url){
        echo 'active';
    } 
  }

?>

<header class="header">
    <div><a href="../index.html"> <img class="logo-header" src="../img/logo.png" alt="Логотип"></a></div>
    <nav class="nav" role="navigation">
      <input class="menu-btn" type="checkbox" id="menu-btn" />
      <label class="menu-icon" for="menu-btn"><span class="bar"></span></label>
      <ul class="menu">
        <li class="home"><a class="icon" href="../index"><span> Главная</span></a></li>
        <li class="gallery <?php active('gallery');?>"><a class="icon <?php active('gallery');?>" href="../gallery"><span>Галерея</span></a></li>
        <li class="ut <?php active('usefulTips');?>"><a class="icon <?php active('usefulTips');?>" href="../usefulTips"><span>Полезные советы</span></a></li>
        <li class="journal <?php active('journal');?>"><a class="icon <?php active('journal');?>" href="../journal"><span>Шляпный журнал</span></a></li>
        <li class="contact <?php active('contacts');?>"><a class="icon <?php active('contacts');?>" href="../contacts"><span>Контакты</span></a></li>
      </ul>			            
    </nav>
</header>