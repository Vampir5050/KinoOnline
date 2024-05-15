<?php
class Film{
	private $pdo;
	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}
	public function getAllFilms(){
		$stmt = $this->pdo->prepare("SELECT * FROM films");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getFilm($film_id){
		$stmt = $this->pdo->prepare("SELECT * FROM films WHERE id = ?");
		$stmt->execute([$film_id]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
?>