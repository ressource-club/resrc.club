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

?>