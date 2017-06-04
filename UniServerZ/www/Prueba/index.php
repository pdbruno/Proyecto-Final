<?php

spl_autoload_register(function ($class) {
    include 'libs/' . $class . '.php';
});


//require 'libs/Bootstrap.php';
//require 'libs/Controller.php';
//require 'libs/View.php';
//require 'libs/Model.php';
require 'config/paths.php';
$app = new Bootstrap();

