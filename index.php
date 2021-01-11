<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Шляпиум - дизайнерские головные уборы от Павловой Светланы.</title>
  <meta name="description" content="Эксклюзивные головные уборы на любую погоду и настроение, сшитые из текстильных материалов: классические широкополые шляпки, вертушки, перевертыши, трансформеры.">
  <meta name="author" content="Павлова Светлана" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="img/icon.png" rel="icon" sizes="any" type="image/png">
  <link href="css/main.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=PT+Serif&display=swap" rel="stylesheet">
  <link href="css/fonts/fonts.css" rel="stylesheet">
  <link href="css/fonts/fontsocial.css" rel="stylesheet"/>
</head>

<body>
  <header class="container_header">
    <div class="parallax"></div>
    <nav class="nav" role="navigation">
      <input class="menu-btn" type="checkbox" id="menu-btn" />
      <label class="menu-icon" for="menu-btn"><span class="bar"></span></label>
      <ul class="menu">		
        <li class="home"><a class="icon home_bar" href="index"><span>Главная</span></a></li>
        <li class="gallery"><a class="icon gallery_bar" href="gallery"><span>Галерея</span></a></li>
        <li class="ut"><a class="icon ut_bar" href="usefulTips"><span>Полезные советы</span></a></li>
        <li class="contact"><a class="icon contact_bar" href="contacts"><span>Контакты</span></a></li>
        <li class="journal"><a class="icon journal_bar" href="journal"><span>Шляпный журнал</span></a></li>
      </ul>
    </nav>
    <h1 class="name">Павлова
      <p>Светлана</p>
    </h1>
    <h2 class="slogan">
      <pre>Они рождаются,
  как скрипки,
    в изгибах
    музыку храня...</pre>
    </h2>
  </header>
  <main class="container_main">
    <div class="container_quote_foto">
        <blockquote>
          <p>Хочешь быть счастливым — <br> не работай ни одного дня.</p>
        </blockquote>
      <div class="foto-desinger"></div>
    </div>
      <h1><span>И</span></h1>
      <p class="text">
        я счастлива. Шляпы я создаю!.. Они рождаются, как скрипки,
        в изгибах музыку храня… Из мимолётно мелькнувших линий,
        впечатлений, творческих импульсов.
      </p>
      <p>
        Всё началось с любопытства. Что будет, если тулью сделать неправильной
        формы? А если удлинить одну сторону поля или опустить поле до талии?
        Я, профессиональный портной, училась шить по ходу дела.
        Потом пришло время Мичуринских экспериментов. Это дало удивительные
        результаты: кепка-шляпа, капюшон-перелина, стали сочиняться первые
        трансформеры.
      </p>
      <p>
        Меня всегда поддерживала моя семья. Спасибо детям, выросших среди лекал,
        макетов, кроя и добровольно-принудительных фотосессий. Спасибо мужу,
        принявшего рутину быта на себя. Особая благодарность Игорю Ивановичу
        Шевченко за возможность перейти из разряда любителей в класс профессионалов. 
        Именно участие в выставке CHAPEAU перевернуло и определило всю
        мою дальнейшую творческую жизнь.
      </p>
      <p>
        Сейчас я работаю в стиле "повседневный эксклюзив". Да, вытворить можно
        всё, что угодно. Но мне хочется, чтобы мои головные уборы носили. Поэтому
        оригинальный дизайн я максимально адаптирую к реальной жизни.
        Более того, я предлагаю интересные модели для людей с проблемами внешности, 
        например шрамы, последствия химиотерапии или дефекты кожи. Шляпы способны
        изящно всё это замаскировать.
        Мои шляпы Вас понимают, подстраиваются под Вас, учитывают Ваш образ
        жизни. Большинство моделей — мягкие, немнущиеся, стирающиеся, легко
        меняющие форму.
      </p>
      <p>
        Если Вы любите открывать нечто новое, не поступаясь при этом удобством —
        эти шляпы для Вас!
      </p>
    <a href="" class="logo_main"></a>
  </main>
  <?php
		require_once 'components/footer.php';
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    $(document).ready(function() {
      var screenHeight = $(window).height();
      $('.container_header').css('height', screenHeight + 'px');
    });
</script>
</body>
</html>