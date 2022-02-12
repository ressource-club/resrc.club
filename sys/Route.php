<?php

function definir_route(string $uri) : string
{
    switch ($uri)
    {
    case '/':
        return 'accueil';
    default:
        $uri = substr($uri, 1, strlen($uri) - 2);
        if (file_exists(__RACINE__ . 'html/' . $uri . '.html')) return $uri;
        header("HTTP/1.1 404 Not Found");
        return 'erreur/404';
    }
}

function proceder(string $uri)
{
    $route = definir_route($_SERVER['REQUEST_URI']);

    include __RACINE__ . 'html/composants/entete.html';
    include __RACINE__ . 'html/' . $route . '.html';
    include __RACINE__ . 'html/composants/pied.html';
}

?>