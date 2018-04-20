<?php
class Auth {

	function login($login, $pass) {
		$user = Db::query("SELECT * FROM users WHERE email = ?", $login)->fetch();
		$verify = password_verify($pass, $user->pass);

		if($verify) {
			setcookie('ulgn', $user->email, time()+432000, '/');
			setcookie('uhash', $user->hash, time()+432000, '/');
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

		$user = Db::query("SELECT * FROM users WHERE email = ?", $login)->fetch();

		if(!empty($user->hash) && !empty($hash) && $hash == $user->hash) {
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
		return Db::query("SELECT id FROM users WHERE email = ?", $_COOKIE['ulgn'])->fetchColumn();
	}

	static function getCurrentUserInfo() {
		return Db::query("SELECT * FROM users WHERE email = ?", $_COOKIE['ulgn'])->fetch();
	}
}