<?php
class Auth {
	private static $user = null;

	function login($login, $pass) {
		$verify = false;
		self::$user = Db::query("SELECT * FROM users WHERE email = ?", $login)->fetch();

		if (!empty(self::$user)) {
			$verify = password_verify($pass, self::$user->pass);

			if($verify) {
				setcookie('ulgn', self::$user->email, time()+432000, '/');
				setcookie('uhash', self::$user->hash, time()+432000, '/');
				$_COOKIE['ulgn'] = self::$user->email;
				$_COOKIE['uhash'] = self::$user->hash;
			}
		}

		return $verify;
	}

	function signup($login, $pass) {

		$password = password_hash($pass, PASSWORD_BCRYPT);
		$hash = Utils::getToken(64);

		$create = Db::query("INSERT INTO users (email,pass,hash) VALUES(?,?,?)", array($login, $password, $hash));

		return true;
	}

	static function isLogged() {

		if(!isset($_COOKIE['ulgn']) || !isset($_COOKIE['uhash'])) {
			return false;
		}

		$email = $_COOKIE['ulgn'];
		$hash  = $_COOKIE['uhash'];

		self::$user = Db::query("SELECT * FROM users WHERE email = ?", $email)->fetch();

		if(!empty(self::$user->hash) && !empty($hash) && $hash == self::$user->hash) {
			return true;
		}

		return false;
	}

	function logout() {
		if(isset($_COOKIE['uhash'])) {
			unset($_COOKIE['uhash']);
			setcookie('uhash', null, -1, '/');
		}
	}

	static function getCurrentUserId() {
		if(isset(self::$user->id)) {
			return self::$user->id;
		}
		return false;
	}

	static function getCurrentUser() {
		if(!empty(self::$user)) {
			return self::$user;
		}
		return false;
	}
}