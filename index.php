<?php
use App\Components\Router;

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

define('ROOT', dirname(__FILE__));
//require_once(ROOT.'/components/Autoload.php');
require_once ROOT. '/App/Components/Autoload.php';

$loader = new Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('App', './App');

$router = new Router();
$router->run();