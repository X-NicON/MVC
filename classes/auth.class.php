<?php
class Auth {
	private static $userInfo = null;

	function login($login, $pass) {
		$verify = false;
		self::$userInfo = Db::query("SELECT * FROM users WHERE email = ?", $login)->fetch();

		if (!empty(self::$userInfo)) {
			$verify = password_verify($pass, $user->pass);

			if($verify) {
				setcookie('ulgn', $user->email, time()+432000, '/');
				setcookie('uhash', $user->hash, time()+432000, '/');
				$_COOKIE['ulgn'] = $user->email;
				$_COOKIE['uhash'] = $user->hash;
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

		self::$userInfo = Db::query("SELECT * FROM users WHERE email = ?", $email)->fetch();

		if(!empty(self::$userInfo->hash) && !empty($hash) && $hash == self::$userInfo->hash) {
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
		if(isset(self::$userInfo->id)) {
			return self::$userInfo->id;
		}
		return false;
	}

	static function getCurrentUserInfo() {
		if(!empty(self::$userInfo)){
			return self::$userInfo;
		}
		return false;
	}
}