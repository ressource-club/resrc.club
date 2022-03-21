<?php

/** Racine du site. */
define('__RACINE__', realpath(__DIR__ . "/../") . '/');

include_once __RACINE__ . 'sys/Route.php';
include_once __RACINE__ . 'sys/Langues.php';
include_once __RACINE__ . 'sys/HTML.php';

if (session_status() == PHP_SESSION_NONE) session_start();
Langues::charger($_SESSION, $_GET);

$route = Routeur::definir_route($_SERVER['REQUEST_URI']);

/** Dossier contenant les données du site. */
const DATA_DOSSIER = __RACINE__ . "public/data/";
HTML::charger($route);

?>