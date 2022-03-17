<?php

const PROJETS_FICHIER = DATA_DOSSIER . 'projets.json';

const CATEGORIE_NOM = 'nom';
const CATEGORIE_PROJETS = 'projets';

const PROJET_NOM = 'nom';
const PROJET_META = 'meta';
const PROJET_META_LIEN = 'lien';
const PROJET_META_GIT = 'git';

const LIEN_TEXTE = 'texte';
const LIEN_URL = 'url';

function charger_projets() : array
{return json_decode(file_get_contents(PROJETS_FICHIER), true) ?? []; }

function afficher_lien(array &$lien) : void
{ print('<a href="' . $lien[LIEN_URL] . '" target="_blank">' . $lien[LIEN_TEXTE] . '</a>'); }

function afficher_projet(array &$projet) : void
{
    print("<li><b>" . $projet[PROJET_NOM] . " : </b><i>");
    if ($no_meta = is_string($projet[PROJET_META]))
        print($_SESSION[LANGUE_INDEX]['mots'][$projet[PROJET_META]]);
    else
        print(afficher_lien($projet[PROJET_META][PROJET_META_LIEN]));
    print('</i>');
    if (!$no_meta && isset($projet[PROJET_META][PROJET_META_GIT]))
    {
        print("<br><small><i>");
        afficher_lien($projet[PROJET_META][PROJET_META_GIT]);
        print("</i></small>");
    }
    print('</li>');
}

function afficher_categorie(array &$categorie, int $i) : void
{
    print('<div class="projets" id="' . (
        isset($categorie[CATEGORIE_NOM]) ? $categorie[CATEGORIE_NOM] : $i
    ) . '">');
    if (isset($categorie[CATEGORIE_NOM]))
        print("<h3>" . $_SESSION[LANGUE_INDEX]['mots'][$categorie[CATEGORIE_NOM]] . "</h3>");
    print('<ul class="liste-projets"><div>');
    $n_projets = count($categorie[CATEGORIE_PROJETS]);
    // TODO Faire une fonction selon n colonnes ?
    for ($p = 0; $p < $n_projets; $p += 3) 
        afficher_projet($categorie[CATEGORIE_PROJETS][$p]);
    if ($n_projets > 1)
    {
        print('</div><div>');
        for ($p = 1; $p < $n_projets; $p += 3) 
            afficher_projet($categorie[CATEGORIE_PROJETS][$p]);
        if ($n_projets > 2)
        {
            print('</div><div>');
            for ($p = 2; $p < $n_projets; $p += 3) 
                afficher_projet($categorie[CATEGORIE_PROJETS][$p]);
        }
    }
    print('</div></ul></div>');
}

?>