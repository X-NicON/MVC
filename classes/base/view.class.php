<?php
class View {
	function __construct($template, $data = null, $full = true, $nav = true) {
		if(!empty($data)) {
			extract($data);
		}

		if($full){
			include 'resources/views/inc/header.php';
			if($nav){
				include 'resources/views/inc/nav.php';
			}
		}

		include 'resources/views/'.$template.'.php';

		if($full) {
			include 'resources/views/inc/footer.php';
		}
	}
}