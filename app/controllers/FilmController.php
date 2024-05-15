<?php
require __DIR__ . '/../models/Film.php';

	class FilmController{
		private $filmModel;
		public function __construct($pdo) {
        	$this->filmModel = new Film($pdo);
    }
	public function films(){
		$films = $this->filmModel->getAllFilms();
		if($films){
			return $films;
		}else{
			echo'Фильмы отсутствуют';
		}
	}
	public function film($film_id){
		$film = $this->filmModel->getFilm($film_id);
		 if($film){
			return $film;
		 }else{
			echo'Фильм отсутствует';
		 }

	}

}
?>