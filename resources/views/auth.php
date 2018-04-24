<?php
	if(!empty($error))
		echo '<div class="alert alert-danger">'.$error.'</div>';
?>

<div class="container">
	<div class="card form-signin">
    <form method="post" action="">
    	<div class="card-header bg-bluegray text-white">
    		<h2>Авторизация</h2>
    	</div>
    	<div class="card-body">
        <div class="form-group">
        	<label for="inputEmail" class="sr-only">Email адрес или телефон</label>
        	<input type="text" id="inputEmail" name="login" class="form-control" placeholder="Имя пользователя" required autofocus>
        </div>
        <div class="form-group">
	        <label for="inputPassword" class="sr-only">Пароль</label>
	        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Пароль" required>
      	</div>
    	</div>
    	<div class="card-footer">
      	<button class="btn btn-outline-info" type="submit">Войти</button>
    	</div>
    </form>
  </div>
</div>