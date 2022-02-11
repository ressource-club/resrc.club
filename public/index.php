<?php

define('__RACINE__', realpath(__DIR__ . "/../") . '/');
include_once __RACINE__ . 'sys/Route.php';
proceder($_SERVER['REQUEST_URI']);

?>