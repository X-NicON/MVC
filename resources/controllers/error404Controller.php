<?php
class error404Controller extends Controller {
	public function init() {
		header('HTTP/1.1 404 Not Found', true, 404);

		echo 'error 404';
	}
}
