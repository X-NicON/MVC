<?php
class MainController extends Controller {
  function init($args) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    }

  	new View('main', [
  		'the_title'=> 'Главная',
  	]);
  }
}