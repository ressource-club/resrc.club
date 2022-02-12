<?php

const LANGUE_DEFAUT = 'fr';
const LANGUE_INDEX = 'lang';
const LANGUE_DOSSIER = __RACINE__ . 'langs/';

function charger_langue(array &$session, array &$get) : array
{
    if (isset($get[LANGUE_INDEX]))
    {
        $fichier = LANGUE_DOSSIER . $get[LANGUE_INDEX] . '.json';
        $session[LANGUE_INDEX] = $get[LANGUE_INDEX];
    }
    else if (isset($session[LANGUE_INDEX]))
        $fichier = LANGUE_DOSSIER . $session[LANGUE_INDEX] . '.json';
    else
    {
        $fichier = LANGUE_DOSSIER . LANGUE_DEFAUT . '.json';
        $session[LANGUE_INDEX] = LANGUE_DEFAUT;
    }
    if (!file_exists($fichier)) $fichier = LANGUE_DOSSIER . LANGUE_DEFAUT . '.json';
    return json_decode(join("\n", file($fichier)), true) ?? [];
}

?>