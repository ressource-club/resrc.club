<?php
define('__RACINE__', realpath(__DIR__ . "/../") . '/');
include_once __RACINE__ . 'Route.php';
$route = definir_route($_SERVER['REQUEST_URI']);

include __RACINE__ . 'html/composants/entete.html';
include_once $route;
include __RACINE__ . 'html/composants/pied.html';

?>