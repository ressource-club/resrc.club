<?php

/** Racine du site. */
define('__RACINE__', realpath(__DIR__ . "/../") . '/');

include_once __RACINE__ . 'sys/Langues.php';
include_once __RACINE__ . 'sys/Route.php';

if (session_status() == PHP_SESSION_NONE) session_start();
Langues::charger($_SESSION, $_GET);

Routeur::route($_SERVER['REQUEST_URI']);

?>