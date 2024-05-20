<?php
require __DIR__ . '/../models/favourites.php';
use Illuminate\Http\Request;

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
		  return;

		}
	}
	public function film($userId, $movieId){
		$favouritesFilm = $this->favouritesModel->checkFilm($userId,$movieId);
		if($favouritesFilm===null){
			$favouritesFilm = $this->favouritesModel->addFilm($userId,$movieId);
			$responseData = [
				'status' => 'success',
				'message' => 'Фильм успешно добавлен в избранное!'
			];
			header('Content-Type: application/json');
         	echo json_encode($responseData);
		}else{
			$favouritesFilm = $this->favouritesModel->delFilm($userId,$movieId);
			$responseData = [
				'status' => 'success',
				'message' => 'Фильм успешно удален из избранного!'
			];
			header('Content-Type: application/json');
            echo json_encode($responseData);
		}
		
		
	}
	public function serial($userId,$serialId){
		$favouritesFilm = $this->favouritesModel->checkSerial($userId,$serialId);
		if($favouritesFilm===null){
			$favouritesFilm = $this->favouritesModel->addSerial($userId,$serialId);
			$responseData = [
				'status' => 'success',
				'message' => 'Сериал успешно добавлен в избранное!'
			];
			header('Content-Type: application/json');
         	echo json_encode($responseData);
		}else{
			$favouritesFilm = $this->favouritesModel->delSerial($userId,$serialId);
			$responseData = [
				'status' => 'success',
				'message' => 'Сериал успешно удален из избранного!'
			];
			header('Content-Type: application/json');
            echo json_encode($responseData);
		}

	}

	

}
?>