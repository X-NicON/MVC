<?php
class error404Controller extends Controller {
	public function init() {
		header('HTTP/1.1 404 Not Found', true, 404);

echo '
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>HTTP 404</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    html {font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}
    body {background-color:#fff;padding:15px;}
    div.title {font-size:32px;font-weight:bold;line-height:1.2em;}
    div.sub-title {font-size:25px;}
    div.descr {margin-top:40px;}
  </style>
</head>
<body>
  <div class="container">
    <div class="title">404 Error</div>
    <div class="sub-title">Ничего не найдено</div>

    <div class="descr">
      <p>Такого адреса не существует.</p>
      <p>Попробуйте вернуться на <a href="/">главную</a> и перейти вновь</p>
    </div>
  </div>
</body>
</html>';

	}
}
