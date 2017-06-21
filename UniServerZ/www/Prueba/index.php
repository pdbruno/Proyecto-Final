<?php

spl_autoload_register(function ($class) {
    include 'libs/' . $class . '.php';
});

require 'config/paths.php';
$app = new Bootstrap();

