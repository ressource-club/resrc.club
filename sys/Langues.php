<?php

const LANGUES_INDEX = 'langs';
const LANGUES_DISPONIBLES_FICHIER = 'langs.json';
const LANGUES_DOSSIER = __RACINE__ . 'langs/';

const LANGUE_INDEX = 'lang';
const LANGUE_PAR_DEFAUT = "fr";

function charger_langues_diponibles(array &$session) : void
{
    $session[LANGUES_INDEX] = json_decode(join("\n", file(
        LANGUES_DOSSIER . LANGUES_DISPONIBLES_FICHIER
    )), true) ?? [];
}

function charger_langue(array &$session, array &$get) : void
{
    if (!isset($session[LANGUES_INDEX])) charger_langues_diponibles($session);
    if (!isset($session[LANGUE_INDEX]) || isset($get[LANGUE_INDEX]))
    {
        if (isset($get[LANGUE_INDEX]))
        {
            $fichier = LANGUES_DOSSIER . $session[LANGUES_INDEX][$get[LANGUE_INDEX]]["fichier"] . '.json';
            if (!file_exists($fichier))
                $fichier = LANGUES_DOSSIER . $session[LANGUES_INDEX][LANGUE_PAR_DEFAUT]["fichier"] . '.json';
        }
        else
            $fichier = LANGUES_DOSSIER . $session[LANGUES_INDEX][LANGUE_PAR_DEFAUT]["fichier"] . '.json';
        $session[LANGUE_INDEX] = json_decode(join("\n", file($fichier)), true) ?? [];
    }
}

?>