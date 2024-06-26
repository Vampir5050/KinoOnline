<?php

session_start();

$user_id = $_SESSION['user_id'] ?? null;

require_once 'app/config/db.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/SerialController.php';
require_once 'app/controllers/FavouritesController.php';

$userController = new UserController($pdo);
$user = $userController->profile($user_id);
$success = $_GET["success"] ?? null;



$serialController = new SerialController($pdo);
$serials = $serialController->serials();

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
	<title>Сериалы</title>
</head>

<body>
	<header class="header">
		<div class="center hd-flex">
			<a href="index.php" class="logo"><img src="/img/popcorn150.svg" alt="logo"></a>
			<a href="films.php"><span  class="cursor-poiner">Фильмы</span></a>
			<a href="serials.php"><span class="cursor-poiner">Сериалы</span></a>
			<div class="search-box">
				<input type="search" name="search" placeholder="Поиск">
			</div>
			<a class="cursor-poiner" onclick="UserClick()">
<?php
	if($user){
	echo '<img class="avatar" src="'. $user['avatar']. '" alt="Аватар пользователя">
	</a>
	<ul class="dropdown-menu">
				<li><a href="/app/views/profile.php"><i class="fa-solid fa-gear"></i></i><span>&#32 Профиль</span></a></li>
				<li><a href="/app/views/favorites.php"><i class="fa-solid fa-heart"></i><span>&#32 Избранное('. $num.')</span></a>
				<li><a href="/public/index.php?controller=user&action=logout"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i><span>&#32 Выйти</span></a>
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
			<div class="sect">
				<div class="sect-items">
				<?php
					if($serials){
						foreach($serials as $serial){
						     echo '<div class="image-container"><a href="/details.php?serial_id='.$serial['id'].'"><img class="poster" src="'. $serial['poster_serial']. '" alt="Постер фильма"></a>
							 		<p class="overlay-text">'. $serial['name_serial'].'</p></div>';
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