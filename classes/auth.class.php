<?php
class Auth {

	function login($login, $pass) {

		$user = Db::query("SELECT * FROM users WHERE login = ?", $login)->fetch();
		$verify = password_verify($pass, $user->pass_hash);

		if($verify) {
			setcookie('ulgn', $user->login, time()+432000, '/');
			setcookie('uhash', $user->auth_hash, time()+432000, '/');
		}

		return $verify;
	}

	function signup($login, $pass) {

		$password = password_hash($pass, PASSWORD_DEFAULT);
		$hash = password_hash(uniqid('hsh', true), PASSWORD_DEFAULT);

		$create = Db::query("INSERT INTO users (login,pass_hash,auth_hash) VALUES(?,?,?)", array($login, $password, $hash));

		return true;
	}

	static function isLogged() {

		if(!isset($_COOKIE['ulgn']) || !isset($_COOKIE['uhash'])) {
			return false;
		}

		$login = $_COOKIE['ulgn'];
		$hash  = $_COOKIE['uhash'];

		$user = Db::query("SELECT * FROM users WHERE login = ?", $login)->fetch();

		if(!empty($user->auth_hash) && !empty($hash) && $hash == $user->auth_hash) {
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
		return Db::query("SELECT id FROM users WHERE login = ?", $_COOKIE['ulgn'])->fetchColumn();
	}

	static function getCurrentUserInfo() {
		return Db::query("SELECT * FROM users WHERE login = ?", $_COOKIE['ulgn'])->fetch();
	}
}