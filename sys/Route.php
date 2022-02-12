<?php

const ROUTE_DEFAUT = 'accueil';
const ROUTE_404 = 'erreur/404';

function definir_route(string $uri) : string
{
    $uri = explode('?', $uri, 2)[0]; // On retire les enventuels arguments GET
    switch ($uri)
    {
    case '/':
        return ROUTE_DEFAUT;
    default:
        $uri = substr($uri, 1, strlen($uri) - 2); // On retire le premier et dernier /
        if (file_exists(HTML_DOSSIER . $uri . '.html')) return $uri;
        header("HTTP/1.1 404 Not Found");
        return ROUTE_404;
    }
}

?>