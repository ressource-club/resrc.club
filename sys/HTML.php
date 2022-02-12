<?php

const HTML_DOSSIER = __RACINE__ . 'html/';

function charger_html(string $fichier)
{
    include HTML_DOSSIER . 'composants/entete.html';
    include HTML_DOSSIER . $fichier . '.html';
    include HTML_DOSSIER . 'composants/pied.html';
}

?>