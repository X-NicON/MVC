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
        	Utils::Redirect('/');
        }else{
          $error = 'Ошибка авторизации';
        }
      }
    }

    if(isset($args[0]) && $args[0] == 'logout'){
      $this->auth->logout();
      Utils::Redirect('/auth/');
    }

    if($this->auth->isLogged()){
    	Utils::Redirect('/');
    }

    $this->view = new View('auth', array(
      'the_title'  => 'Авторизация',
      'error'      => $error
    ), true, false);
  }
}