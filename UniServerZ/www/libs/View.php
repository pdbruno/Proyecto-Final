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

	public function render2modales($name, $ConDrop = false)
	{
		require 'views/header.php';
		if ($ConDrop == true) {
			require 'views/tablas/index.php';
		}
		require 'views/bstable/index.php';
		require 'views/modalprop/index.php';
		require 'views/recursos/logicaABM.php';
		require 'views/' . $name . '/' . $name . '.php';
		require 'views/footer.php';
	}

	public function renderTabla($name = "", $ConModal = false)
	{
		require 'views/header.php';
		require 'views/bstable/index.php';
		if ($ConModal == true) {
			require 'views/modalprop/index.php';
			require 'views/modalprop/modalprop.php';
		}else {
			require 'views/' . $name . '/index.php';
			require 'views/' . $name . '/' . $name . '.php';
		}
		require 'views/recursos/logicaABM.php';
		require 'views/footer.php';
	}

}
