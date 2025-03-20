<?php
// controllers/UserController.php

include_once '../config/db.php';
include_once '../models/User.php';

class UserController {

    public static function registerUser($data) {
        if (isset($data['username'], $data['email'], $data['password'])) {
            $result = User::registerUser($data['username'], $data['email'], $data['password']);
            return ["success" => $result, "message" => $result ? "User registered successfully!" : "Registration failed."];
        }
        return ["success" => false, "message" => "Missing required fields."];
    }

    public static function loginUser($data) {
        if (isset($data['email'], $data['password'])) {
            $user = User::loginUser($data['email'], $data['password']);
            return $user ? ["success" => true, "user" => $user] : ["success" => false, "message" => "Invalid credentials."];
        }
        return ["success" => false, "message" => "Missing email or password."];
    }

    public static function getUserById($id) {
		$user = User::getUserById($id);
		return $user ? ["success" => true, "user" => $user] : ["success" => false, "message" => "User not found."];
	}

}
?>
