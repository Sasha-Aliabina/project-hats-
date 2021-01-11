<?php

require_once '../api/conn.php';

$stmt = $connection->prepare('SELECT * FROM gallery ORDER BY id');
$stmt->execute();

$gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title>Шляпиум - галерея уникальных головных уборов от Павловой Светланы.</title>
	<meta name="description" content="Оригинальный дизайн шапок и шляп, авторская технология. Комфорт, эстетика и практичность в каждом творении. Галерея эксклюзивных шляп.">
	<meta name="author" content="Павлова Светлана" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="../img/icon.png" rel="icon" sizes="any" type="image/png">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/gallery_fix.css" rel="stylesheet">
	<link href= "https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=PT+Serif&display=swap" rel="stylesheet">
	<link href="../css/fonts/fonts.css" rel="stylesheet" />
	<link href="../css/fonts/fontsocial.css" rel="stylesheet"/>
	<script src="../js/modernizr.custom.js"></script>
</head>
<body>
 	<?php
		require_once '../components/header.php';
	?>
 	<div class="wrapper">
    	<div class="container">	
			<ul id="og-grid" class="og-grid">
			<?php foreach ($gallery as $g): ?>
				<li>
					<a href="" data-largesrc="../pshats/img/<?=$g['photo']?>" data-title="<?=$g['title']?>" data-description="<?=$g['content']?>">
						<img class="object-img" src="../pshats/img/thumbs/<?=$g['photo_xs']?>" alt="<?=$g['title']?>"/>
					</a>
				</li>
			<?php endforeach; ?>
        	</ul>
    	</div>
	</div>
 	<?php
		require_once '../components/footer.php';
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/grid.js"></script>
  <script>
    $(function() {
      Grid.init();
    });
  </script>
</body>
</html>