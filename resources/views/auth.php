<?php
	if(!empty($error))
		echo '<div class="alert alert-danger">'.$error.'</div>';
?>

<div class="container">
	<form class="form-signin" method="post">
		<div class="form-signin-heading">Вход</div>
		<div class="form-group">
	  	<input type="text" name="login" class="form-control" placeholder="Имя пользователя" required autofocus>
	  </div>
	  <div class="form-group">
	  	<input type="password" name="pass" class="form-control" placeholder="Пароль" required>
	  </div>
	  <button class="btn btn-info" type="submit">Войти</button>
	</form>
</div>