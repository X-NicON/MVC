<?php
class logoutController extends Controller {
	public function init($args){
		$this->auth = new AuthModel();
		$this->auth->logout();

		Utils::redirect_to('./');
	}
}
?>