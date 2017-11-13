<?php

class View {

	function __construct() {
	}

	public function render($Nombre, $NoInclude = false)
	{
		if ($NoInclude == true) {
			require 'views/' . $Nombre . '/index.php';
		}
		else {
			require 'views/header.php';
			require 'views/' . $Nombre . '/index.php';
			require 'views/recursos/logicaABM.php';
			require 'views/' . $Nombre . '/' . $Nombre . '.php';
			require 'views/footer.php';
		}
	}

	public function render2modales($Nombre)
	{
		require 'views/header.php';
		require 'views/bstable/index.php';
		require 'views/modalprop/index.php';
		require 'views/recursos/logicaABM.php';
		require 'views/' . $Nombre . '/' . $Nombre . '.php';
		require 'views/footer.php';
	}

	public function renderTempSimple($Nombre, $Template, $DefaultJS = false)
	{
		require 'views/header.php';
		require 'views/' . $Template . '/index.php';
		require 'views/recursos/logicaABM.php';
		if ($DefaultJS) {
			require 'views/' . $Template . '/' . $Template . '.php';
		} else {
			require 'views/' . $Nombre . '/' . $Nombre . '.php';
		}
		require 'views/footer.php';
	}

	public function renderTabla($Nombre = "", $ConModal = false)
	{
		require 'views/header.php';
		require 'views/bstable/index.php';
		if ($ConModal == true) {
			require 'views/modalprop/index.php';
			require 'views/recursos/logicaABM.php';
			require 'views/modalprop/modalprop.php';
		}else {
			require 'views/' . $Nombre . '/index.php';
			require 'views/recursos/logicaABM.php';
			require 'views/' . $Nombre . '/' . $Nombre . '.php';
		}
		require 'views/footer.php';
	}

}
