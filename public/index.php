<?php

require_once(dirname(__DIR__, 1) . '/vendor/autoload.php');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

#opcao 01

use App\Route;
$route = new Route();

?>
