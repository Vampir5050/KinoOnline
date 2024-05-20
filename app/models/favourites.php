<?php
class Favourites{
	private $pdo;
	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}
	public function getAllFavorites($user_id){
    $stmt = $this->pdo->prepare("SELECT * FROM favorites f JOIN users u ON f.user_id = ? LEFT JOIN films ON f.film_id = films.id LEFT JOIN serials ON f.serial_id = serials.id ORDER BY f.added_date DESC");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
	public function addFilm($user_id,$film_id){
		$stmt = $this->pdo->prepare('INSERT INTO favorites (user_id,film_id) VALUES (?,?)');
		$stmt->execute([$user_id,$film_id]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function addSerial($user_id,$serial_id){
		$stmt = $this->pdo->prepare('INSERT INTO favorites (user_id,serial_id) VALUES (?,?)');
		$stmt->execute([$user_id,$serial_id]);
		return $this->pdo->lastInsertId();
	}
	public function delFilm($user_id,$film_id){
		$stmt = $this->pdo->prepare('DELETE FROM favorites WHERE user_id = ? AND film_id = ? ');
		$stmt->execute([$user_id,$film_id]);
		return $this->pdo->lastInsertId();
	}
	public function delSerial($user_id,$serial_id){
		$stmt = $this->pdo->prepare('DELETE FROM favorites WHERE user_id = ? AND serial_id = ? ');
		$stmt->execute([$user_id,$serial_id]);
		return $this->pdo->lastInsertId();
	}
	public function checkSerial($user_id,$serial_id){
		$stmt = $this->pdo->prepare('SELECT user_id, serial_id FROM favorites WHERE user_id = ? AND serial_id = ?');
		$stmt->execute([$user_id,$serial_id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result === false){
			return null;
		}
		else{
			return $result;
		}
	}
	public function checkFilm($user_id,$film_id){
		$stmt = $this->pdo->prepare('SELECT user_id, film_id FROM favorites WHERE user_id = ? AND film_id = ?');
		$stmt->execute([$user_id,$film_id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result === false){
			return null;
		}
		else{
			return $result;
		}
	}
}
?>