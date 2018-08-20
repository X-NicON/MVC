<?php
class authController extends Controller {

  function __construct(){
    $this->onlyauth = false;
  }

  function init($args) {
  	$this->auth = new Auth();
    $error = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if(isset($_POST['login'], $_POST['pass'])) {
        if($this->auth->login($_POST['login'], $_POST['pass'])) {
        	Utils::Redirect(Routing::home());
        }else{
          $error = 'Ошибка авторизации';
        }
      }
    }

    if(isset($args[0]) && $args[0] == 'logout') {
      $this->auth->logout();
      Utils::Redirect(Routing::home().'auth/');
    }

    if($this->auth->isLogged()) {
    	Utils::Redirect(Routing::home());
    }

    $this->view = new View('auth', array(
      'the_title'  => 'Авторизация',
      'error'      => $error
    ), true, false);
  }
}