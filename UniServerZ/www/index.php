<?php
session_start();
spl_autoload_register(function ($class) {
    require 'libs/' . $class . '.php';
});
require 'vendor/autoload.php';
require 'config/paths.php';
$bootstrap = new Bootstrap();
