<?php
define('__RACINE__', realpath(__DIR__ . "/../") . '/');
include_once __RACINE__ . 'Route.php';

include __RACINE__ . 'html/composants/entete.html';

echo $_SERVER['REQUEST_URI'];
// definir_route($_SERVER['REQUEST_URI']);

include __RACINE__ . 'html/composants/pied.html';

?>