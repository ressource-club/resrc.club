<?php

function definir_route(string $uri) : void
{
    switch ($uri)
    {
    default:
        include __RACINE__ . 'html/citation.html';
        break;
    }
}

?>