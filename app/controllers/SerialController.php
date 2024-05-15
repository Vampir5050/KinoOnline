<?php
require __DIR__ . '/../models/Serial.php';

	class SerialController{
		private $serialModel;
		public function __construct($pdo) {
        	$this->serialModel = new Serial($pdo);
    }
	public function serials(){
		$serials = $this->serialModel->getAllSerials();
		if($serials){
			return $serials;
		}else{
			echo'Сериалы отсутствуют';
		}
	}
	public function serial($serial_id){
		$serial = $this->serialModel->getSerial($serial_id);
		 if($serial){
			return $serial;
		 }else{
			echo'Сериал отсутствует';
		 }
		}

}
?>