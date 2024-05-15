<?php
class User{
	private $pdo;
	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}
	public function createUser($username, $email, $password){
		$avatar = "/img/noavatar.png";
		$stmt = $this->pdo->prepare('INSERT INTO users (username, email, password, avatar)VALUES(?,?,?,?)');
		$stmt->execute([$username, $email, password_hash($password,PASSWORD_BCRYPT),$avatar]);
		return $this->pdo->lastInsertId();
	}
	 public function updateUser($id, $username, $email) {
            $stmt = $this->pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
            $stmt->execute([$username, $email, $id]);
        }

        public function getUserById($id) {
            $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getUserByEmail($email) {
            $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
		
}
?>