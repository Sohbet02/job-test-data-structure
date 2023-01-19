<?php

class Account extends Database {
    private static function insertTestUser() {
        $db = self::connect();

        $email = "johndoe@gmail.com";
        $password = "johndoe";
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hash);
        $stmt->execute();
        $db->close();
    }

    private static function getByEmail($email) {
        $db = self::connect();

        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $result = $db->query($sql);

        if ($result) {
            return $result->fetch_assoc();
        }
        return false;

        $db->close();
	}

    public static function authorize($email, $password) {
		$user = self::getByEmail($email);
		if(!empty($user) && password_verify($password, $user['password'])) {
            return $user;
		} else {
			return false;
		}
	}

    
}