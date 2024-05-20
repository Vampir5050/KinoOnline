<?php

session_start();

$user_id = $_SESSION['user_id'] ?? null;
$film_id = $_GET['film_id']?? null;
$serial_id = $_GET['serial_id']??null;

require_once 'app/config/db.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/FilmController.php';
require_once 'app/controllers/SerialController.php';
require_once 'app/controllers/FavouritesController.php';
$num=0;
$userController = new UserController($pdo);
if($user = $userController->profile($user_id)){
	$favouritesController = new FavouritesController($pdo);
	$favourites = $favouritesController->favourites($user['id']);	
	if($favourites){
		$num = (count($favourites));
	}
}


$filmController = new FilmController($pdo);
if($film = $filmController->film($film_id)){
	if($num!=0){
		$isFavourite = in_array($film_id,array_column($favourites,'film_id'));
		$iconClass = $isFavourite? 'fa-solid solid-star-img' : 'fa-regular regular-star-img';
	}
	else{
		$iconClass = 'fa-regular regular-star-img';
	}
	if($user){
			$htmlFilm = '<div class="details"><img class="poster" src="'. $film['poster_film']. '" alt="Постер фильма"><a class="add-to-film" data-film-id="'.$film['id'].'" data-user-id="'.$user['id'].'" href="#"><i class="'.$iconClass.' fa-star"></i></a>
							 		<p>Фильм: '. $film['name_film'].'</p>
									<p>Жанр: '. $film['ganre'] .'</p>
									<p>Страна: '. $film['country'] .'</p>
									<p>Год релиза: '. $film['year_release'] .'</p></div>
									<iframe class="watch" width="560" height="315" src="'.$film['link_film'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
	}
	else{
		$htmlFilm = '<div class="details"><img class="poster" src="'. $film['poster_film']. '" alt="Постер фильма">
							 		<p>Фильм: '. $film['name_film'].'</p>
									<p>Жанр: '. $film['ganre'] .'</p>
									<p>Страна: '. $film['country'] .'</p>
									<p>Год релиза: '. $film['year_release'] .'</p></div>
									<iframe class="watch" width="560" height="315" src="'.$film['link_film'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
	}

}

$serialController = new SerialController($pdo);
if($serial = $serialController->serial($serial_id)){
	if($num!=0){
		$isFavourite = in_array($serial_id,array_column($favourites,'serial_id'));
		$iconClass = $isFavourite? 'fa-solid solid-star-img' : 'fa-regular regular-star-img';
	}
	else{
		$iconClass = 'fa-regular regular-star-img';
	}
	if($user){
		$htmlSerial = '<div class="details"><img class="poster" src="'. $serial['poster_serial']. '" alt="Постер фильма"><a class="add-to-serial" data-serial-id="'.$serial['id'].'" data-user-id="'.$user['id'].'" href="#"><i class="'.$iconClass.' fa-star "></i></a>
							 		<p>Сериал: '. $serial['name_serial'].'</p>
									<p>Жанр: '. $serial['ganre'] .'</p>
									<p>Страна: '. $serial['country'] .'</p>
									<p>Год релиза: '. $serial['year_release'] .'</p></div>';
	}
	else{
		$htmlSerial = '<div class="details"><img class="poster" src="'. $serial['poster_serial']. '" alt="Постер фильма">
							 		<p>Сериал: '. $serial['name_serial'].'</p>
									<p>Жанр: '. $serial['ganre'] .'</p>
									<p>Страна: '. $serial['country'] .'</p>
									<p>Год релиза: '. $serial['year_release'] .'</p></div>';
	}
	
}



$success = $_GET["success"] ?? null;






?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/public/assets/css/style.css">
	<title>Детали</title>
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
				<li><a href="/app/views/favorites.php"><i class="fa-solid fa-heart"></i><span>&#32 Избранное('.$num.')</span></a>
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
				<?php
					if($film){
						     echo $htmlFilm;
						}
					if($serial){
						echo $htmlSerial;
					}
					?>	
		</main>
	</div>

</body>
<script src="https://kit.fontawesome.com/61d030ecc5.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/public/assets/js/addFabourites.js"></script>
<script src="/public/assets/js/index.js"></script>

</html>