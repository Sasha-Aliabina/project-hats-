<?php

require_once '../api/conn.php';

$stmt = $connection->prepare('SELECT * FROM usefultips ORDER BY id');
$stmt->execute();

$usefultips = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Шляпиум - полезные советы для любителей головных уборов.</title>
  <meta name="description" content="Как снять мерки? Как выбрать головной убор? Как правильно ухаживать и чем чистить шапку? С чем носить шляпку? И другие важные вопросы..">
  <meta name="author" content="Павлова Светлана" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="../img/icon.png" rel="icon" sizes="any" type="image/png">
  <link href="../css/style.css" rel="stylesheet">
  <link href= "https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=PT+Serif&display=swap" rel="stylesheet">
  <link href="../css/fonts/fonts.css" rel="stylesheet" />
  <link href="../css/fonts/fontsocial.css" rel="stylesheet"/>
</head>
<body>
  <?php
    require_once '../components/header.php';
	?>
  <div class="wrapper">
    <div class=conteinerFAQ>
      <h2 class="usefultips_h2">Полезные советы</h2>
      <?php foreach ($usefultips as $ut): ?>
        <div class="accordion">
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title"><?=$ut['title']?></span><span class="icon" aria-hidden="true"></span></button>
              <div class="accordion-content">
                <?=$ut['content']?>
              </div>
          </div>
      <?php endforeach; ?>
        </div>
    </div>
  </div>
  <?php
		require_once '../components/footer.php';
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
  <script src="../js/main.js"></script>
</body>
</html>