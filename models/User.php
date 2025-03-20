<?php
// models/User.php

class User {
    public $id;
    public $username;
    public $email;
    public $password; // Hashed password

    public function __construct($id = null, $username = "", $email = "", $password = "") {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // Register a new user
    public static function registerUser($username, $email, $password) {
        global $pdo;

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    // Login user
    public static function loginUser($email, $password) {
        global $pdo;

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data if login successful
        } else {
            return null; // Login failed
        }
    }

    // Get user by ID
    public static function getUserById($id) {
        global $pdo;

        $sql = "SELECT id, username, email FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
