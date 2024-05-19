<?php

session_start();

$user_id = $_SESSION['user_id'] ?? null;

require_once '../config/db.php';
require_once '../controllers/UserController.php';
require_once '../controllers/FavouritesController.php';

$userController = new UserController($pdo);
$user = $userController->profile($user_id);
$success = $_GET["success"] ?? null;

if($user){
	$favouritesController = new FavouritesController($pdo);
	$favourites = $favouritesController->favourites($user['id']);	
	if($favourites){
		$num = (count($favourites));
	}
	else{
		$num = 0;
	}
}







?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/public/assets/css/style.css">
	<title>Document</title>
</head>

<body>
	<header class="header">
		<div class="center hd-flex">
			<a href="/index.php" class="logo"><img src="/img/popcorn150.svg" alt="logo"></a>
			<a href="/films.php"><span  class="cursor-poiner">Фильмы</span></a>
			<a href="/serials.php"><span class="cursor-poiner">Сериалы</span></a>
			<div class="search-box">
				<input type="search" name="search" placeholder="Поиск">
			</div>
			<a class="cursor-poiner" onclick="UserClick()">
<?php
	if($user){
	echo '<img class="avatar" src="'. $user['avatar']. '" alt="Аватар пользователя">
	</a>
	<ul class="dropdown-menu">
				<li><a href="#"><i class="fa-solid fa-gear"></i></i><span>&#32 Профиль</span></a></li>
				<li><a href="#"><i class="fa-solid fa-heart"></i><span>&#32 Избранное('.$num.')</span></a>
				<li><a href="/../public/index.php?controller=user&action=logout"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i><span>&#32 Выйти</span></a>
				</li>
	</ul>';
		}else{
			echo '<i class="fa-solid fa-user"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="/public/login.html"><i class="fa-solid fa-lock"></i><span>&#32 Войти</span></a></li>
				<li><a href="/public/register.html"><i class="fa-solid fa-plus"></i><span>&#32 Регистрация</span></a>
				</li>
			</ul>';
		}
?>
	
		</div>
	</header>
	<div class="cont">
		<main class="main">
				<div class="sect-items">
				<?php
					if($favourites){
						foreach($favourites as $favourite){
							if($favourite['name_serial']!=null)
							{
								echo '<div class="image-container"><a href="/details.php?serial_id='.$favourite['serial_id'].'"><img class="poster" src="'. $favourite['poster_serial']. '" alt="Постер фильма"></a>
							 		<p class="overlay-text">'. $favourite['name_serial'].'</p></div>';
							}
							if($favourite['name_film']!=null){
							 echo '<div class="image-container"><a href="/../details.php?film_id='.$favourite['film_id'].'"><img class="poster" src="'. $favourite['poster_film']. '" alt="Постер фильма"></a>
							 		<p class="overlay-text">'. $favourite['name_film'].'</p></div>';
						}
						    
					}
						
					}
					?>
				</div>
			</div>
		</main>
	</div>

</body>
<script src="https://kit.fontawesome.com/61d030ecc5.js" crossorigin="anonymous"></script>
<script src="/public/assets/js/index.js"></script>

</html>