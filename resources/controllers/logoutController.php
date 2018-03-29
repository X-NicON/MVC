<?php
class logoutController extends Controller {

	function __construct(){
		$this->onlyauth = false;
	}

	public function init($args){
		$this->auth = new Auth();
		$this->auth->logout();

		Utils::Redirect('./');
	}
}