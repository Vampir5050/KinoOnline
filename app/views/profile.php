<?php

session_start();

$user_id = $_SESSION['user_id'] ?? null;

require_once '../config/db.php';
require_once '../controllers/UserController.php';
require_once '../controllers/FavouritesController.php';

$userController = new UserController($pdo);
$user = $userController->profile($user_id);
$success = $_GET["success"] ?? null;
if($success==null){
	echo'<div>Сначало авторизуйтесь!</div><p><a href="/../index.php">Главная</a></p>';
	exit();
}
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
	<title>Профиль</title>
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
	echo '<img class="avatar" src="'. $user['avatar']. '" alt="Аватар пользователя">
	</a>
	<ul class="dropdown-menu">
				<li><a href="#"><i class="fa-solid fa-gear"></i></i><span>&#32 Профиль</span></a></li>
				<li><a href="favorites.php"><i class="fa-solid fa-heart"></i><span>&#32 Избранное('.$num.')</span></a>
				<li><a href="/../public/index.php?controller=user&action=logout"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i><span>&#32 Выйти</span></a>
				</li>
	</ul>'
?>
	
		</div>
	</header>
	<div class="profile">
		<?php
		echo '<div><img src="'.$user['avatar'].'"></div>
		<div class="user"><p>Пользователь: '.$user['username'].'</p>
		<p>Email: '.$user['email'].'</p>
		<p>Дата регестирации: '.$user['create_at'].'</p><div>'
		?>
	</div>


</body>
<script src="https://kit.fontawesome.com/61d030ecc5.js" crossorigin="anonymous"></script>
<script src="/public/assets/js/index.js"></script>

</html>