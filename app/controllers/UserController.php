<?php

require __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function register($username, $email, $password) {
        if ($this->userModel->getUserByEmail($email)) {
            echo "Пользователь с таким email уже существует";
            return;
        }

        $this->userModel->createUser($username, $email, $password);
        header("Location: ../index.php");
    }

    public function login($email, $password) {
        $user = $this->userModel->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../index.php");
        } else {
            echo "Неверный email или пароль";
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    }

    public function profile($user_id) {
        $user = $this->userModel->getUserById($user_id);
        if ($user) {
            return $user;
        } else {
			return;
        }
    }

    public function updateProfile($user_id, $username, $email) {
        $this->userModel->updateUser($user_id, $username, $email);
        header("Location: ../app/views/profile.php?success=true");
    }
}

?>
