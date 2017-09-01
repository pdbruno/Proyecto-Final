<?php

class View {

	function __construct() {
	}

	public function render($name, $noInclude = false)
	{
		if ($noInclude == true) {
			require 'views/' . $name . '/index.php';
		}
		else {
			require 'views/header.php';
			require 'views/' . $name . '/index.php';
			require 'views/recursos/logicaABM.php';
			require 'views/' . $name . '/' . $name . '.php';
			require 'views/footer.php';
		}
	}

}
