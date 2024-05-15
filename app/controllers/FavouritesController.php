<?php
require __DIR__ . '/../models/favourites.php';

	class FavouritesController{
		private $favouritesModel;
		public function __construct($pdo) {
        	$this->favouritesModel = new Favourites($pdo);
    }
	public function favourites($user_id){
		$favourites = $this->favouritesModel->getAllFavorites($user_id);
		if($favourites){
			return $favourites;
		}else{
			echo'В избранном ничего нет';

		}
	}
	public function film($user_id,$film_id){
		$favouritesFilm = $this->favouritesModel->checkFilm($user_id,$film_id);
		if($favouritesFilm['film_id']==null){
			$favouritesFilm = $this->favouritesModel->addFilm($user_id,$film_id);
		}
		else{
			$favouritesFilm = $this->favouritesModel->delFilm($user_id,$film_id);
		}
		return $favouritesFilm;
		
	}
	public function serial($user_id,$serial_id){
		$favouritesFilm = $this->favouritesModel->checkSerial($user_id,$serial_id);
		if($favouritesFilm['serial_id']==null){
				$favouritesFilm = $this->favouritesModel->addSerial($user_id,$serial_id);
		}
		else{
			$favouritesFilm = $this->favouritesModel->delFilm($user_id,$serial_id);
		}return $favouritesFilm;

	}

	

}
?>