<?php
spl_autoload_register(function ($class) {
    include 'libs/' . $class . '.php';
});
require_once 'vendor/autoload.php';
require_once 'config/paths.php';
$bootstrap = new Bootstrap();
