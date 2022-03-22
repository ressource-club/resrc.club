<?php

/**
 * Utilitaires relatifs aux projets.
 */
abstract class Projets
{
    /** Nom de la ressource associé à la liste des projets. */
    private const RESSOURCE = 'projets';

    /** Clé du nom d'une catégorie de projets. */
    private const CATEGORIE_NOM = 'nom';
    /** Clé du tableau des projets d'une catégorie. */
    private const CATEGORIE_PROJETS = 'projets';

    /** Clé du nom d'un projet. */
    private const NOM = 'nom';
    /** Clé des informations d'un projet. */
    private const META = 'meta';
    /** Clé du lien vers le site d'un projet. */
    private const META_LIEN = 'lien';
    /** Clé du lien vers le code source d'un projet. */
    private const META_GIT = 'git';

    /**
     * Chargement de la liste des projets depuis le fichier JSON dédié.
     * @return array Contenu désérialisé du fichier.
     */
    public static function charger() : array
    {return json_decode(Data::lire(self::RESSOURCE), true); }

    /**
     * Affichage d'un projet depuis un tableau issu d'un JSON.
     * @param array &$projet Tableau des informations du projet.
     * @param array &$session Tableau de session.
     */
    private static function afficher_projet(array &$projet, array &$session) : void
    {
        // Affichage du titre du projet.
        print("<li><b>" . $projet[self::NOM] . " : </b><i>");
        // Affichage du lien associé au projet s'il existe.
        if ($meta = is_array($projet[self::META]))
            HTML::afficher_lien($projet[self::META][self::META_LIEN], $session);
        // Autrement, affichage du message associé au projet.
        else print(Langues::mot($projet[self::META], $session) ?? $projet[self::META]);
        print('</i>');
        // Affichage du lien du code source du projet s'il existe.
        if ($meta && isset($projet[self::META][self::META_GIT]))
        {
            print("<br><small><i>");
            $git = $projet[self::META][self::META_GIT];
            if (is_array($git)) HTML::afficher_lien($git, $session);
            // S'il ne s'agit pas d'un lien mais une chaîne de caractère, on l'affiche.
            else if (is_string($git)) print(Langues::mot($git, $session) ?? $git);
            print("</i></small>");
        }
        print('</li>');
    }

    /**
     * Affichage d'une catégorie de projets depuis un tableau issu d'un JSON.
     * @param array &$categorie Tableau représentant la catégorie de projets.
     * @param int $i Index associé à la catégorie.
     * @param array &$session Tableau de session.
     */
    public static function afficher_categorie(array &$categorie, int $i, array &$session) : void
    {
        print('<div class="projets" id="' . (
            isset($categorie[self::CATEGORIE_NOM]) ? $categorie[self::CATEGORIE_NOM] : $i
        ) . '">');
        // Affichage du titre de la catégorie.
        if (isset($categorie[self::CATEGORIE_NOM]))
            print("<h3>" . Langues::mot($categorie[self::CATEGORIE_NOM], $session) . "</h3>");
        // Affichage de la liste des projets en colonne.
        print('<ul class="liste-projets"><div>');
        $n_projets = count($categorie[self::CATEGORIE_PROJETS]);
        // TODO Faire une fonction selon n colonnes
        for ($p = 0; $p < $n_projets; $p += 3) 
            self::afficher_projet($categorie[self::CATEGORIE_PROJETS][$p], $session);
        if ($n_projets > 1)
        {
            print('</div><div>');
            for ($p = 1; $p < $n_projets; $p += 3) 
                self::afficher_projet($categorie[self::CATEGORIE_PROJETS][$p], $session);
            if ($n_projets > 2)
            {
                print('</div><div>');
                for ($p = 2; $p < $n_projets; $p += 3) 
                    self::afficher_projet($categorie[self::CATEGORIE_PROJETS][$p], $session);
            }
        }
        print('</div></ul></div>');
    }
}