<?php
class MainController extends Controller {
  function init($args) {

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['price'], $_POST['group_id'], $_POST['break_id'])) {

    }

  	new View('main', [
  		'the_title'=> 'Главная',
  	]);
  }
}