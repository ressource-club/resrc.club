<?php

/**
 * Gestion des données publiques.
 */
abstract class Data
{
    /** Dossier contenant les données publiques du site. */
    private const DOSSIER = __RACINE__ . "public/data/";
    /** Extension des fichiers de données. */
    private const EXT = 'json';
    /** Type MIME associé aux fichiers de données. */
    private const MIME = 'application/' . self::EXT;

    /**
     * Retourne le nom de fichier pour un nom de ressource donné.
     * @param string $nom Nom de la ressource cible.
     * @return string Nom du fichier associé.
     */
    private static function fichier(string $nom): string
    { return self::DOSSIER . $nom . '.' . self::EXT; }

    /**
     * Chargement et affichage d'un fichier de données publique.
     * @param string $nom Nom de la ressource cible.
     */
    public static function charger(string $nom) : void
    {
        $fichier = self::fichier($nom);
        if (file_exists($fichier))
        {
            header('Content-type: ' . self::MIME);
            include $fichier;
        }
        else 
        {
            Routeur::err_404();
            print("Cette ressource n'existe pas.");
        }
    }

    /**
     * Lecture du contenu d'un fichier de données publique.
     * @param string $fichier Nom de la ressource cible.
     * @return null|string Contenu du fichier, ou null si le fichier n'existe pas.
     */
    public static function lire(string $nom) : ?string
    {
        $fichier = self::fichier($nom);
        if (file_exists($fichier)) return file_get_contents($fichier);
        return null;
    }
}