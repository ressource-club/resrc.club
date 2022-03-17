<?php
// TODO Ajouter des classes, même abstraites, pour organiser les fichiers PHP.

// La racine du système est le dossier parent.
define('__RACINE__', realpath(__DIR__ . "/../") . '/');

include_once __RACINE__ . 'sys/Route.php';
include_once __RACINE__ . 'sys/Langues.php';
include_once __RACINE__ . 'sys/HTML.php';

// Langue
if (session_status() == PHP_SESSION_NONE) session_start();
charger_langue($_SESSION, $_GET);

// Routage
$route = definir_route($_SERVER['REQUEST_URI']);

// HTML
const DATA_DOSSIER = __RACINE__ . "public/data/";
charger_html($route);

?>