<?php

const LANGUE_DEFAUT = 'fr';
const LANGUE_INDEX = 'lang';
const LANGUE_DOSSIER = __RACINE__ . 'langs/';

function charger_langue(array &$session, array &$get)
{
    if (!isset($session[LANGUE_INDEX]) || isset($get[LANGUE_INDEX]))
    {
        if (isset($get[LANGUE_INDEX]))
        {
            $fichier = LANGUE_DOSSIER . $get[LANGUE_INDEX] . '.json';
            if (!file_exists($fichier))
                $fichier = LANGUE_DOSSIER . LANGUE_DEFAUT . '.json';
        }
        else
            $fichier = LANGUE_DOSSIER . LANGUE_DEFAUT . '.json';
        $session[LANGUE_INDEX] = json_decode(join("\n", file($fichier)), true) ?? [];
    }
}

?>