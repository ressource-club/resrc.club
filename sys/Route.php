<?php

function definir_route(string $uri) : string
{
    switch ($uri)
    {
    case '/':
        return __RACINE__ . 'html/citation.html';
    default:
        header("HTTP/1.1 404 Not Found");
        return __RACINE__ . 'html/404.html';
    }
}

function proceder(string $uri)
{
    $route = definir_route($_SERVER['REQUEST_URI']);

    include __RACINE__ . 'html/composants/entete.html';
    include $route;
    include __RACINE__ . 'html/composants/pied.html';
}

?>