<?php
define('__RACINE__', realpath(__DIR__ . "/../") . '/');

include_once __RACINE__ . 'sys/Route.php';
include_once __RACINE__ . 'sys/Langues.php';
include_once __RACINE__ . 'sys/HTML.php';

// Langue
if (session_status() == PHP_SESSION_NONE) session_start();
$_LANGUE = charger_langue($_SESSION, $_GET);

// Routage
$route = definir_route($_SERVER['REQUEST_URI']);

// HTML
charger_html($route, $_LANGUE);

?>