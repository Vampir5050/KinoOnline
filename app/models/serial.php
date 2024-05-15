<?php
class Serial{
	private $pdo;
	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}
	public function getAllSerials(){
		$stmt = $this->pdo->prepare("SELECT * FROM serials");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
		public function getSerial($serial_id){
		$stmt = $this->pdo->prepare("SELECT * FROM serials WHERE id = ?");
		$stmt->execute([$serial_id]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
?>