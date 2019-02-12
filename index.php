<?php

//require_once 'src/Core.php';
spl_autoload_register(function ($class) {
    $file = str_replace('\\','/',$class);
    require_once 'src/' . $file . '.php';
});

use App\Core;

/*
 * Int
 */
$gridSize = 15;//$_POST['grid_size'];


$run = new Core($gridSize);
$run->run();