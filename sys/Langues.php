<?php

/**
 * Gestion des traductions.
 */
abstract class Langues
{
    /** Dossier racine des langues. */
    private const DOSSIER = __RACINE__ . 'langs/';
    /** Nom du fichier indiquant les langues disponibles. */
    private const DISPONIBLES_FICHIER = self::DOSSIER . 'langs.json';
    
    /** Dossier des données de traduction relatives aux langues. */
    private const DATA_DOSSIER = self::DOSSIER . 'data/';
    /** Extension des fichiers de traduction. */
    private const DATA_EXT = 'json';
    /** Clé des mots dans les tableau de traduction. */
    private const MOTS = 'mots';
    /** Clé du tableau des éléments dans les tableau de traduction. */
    public const ELEM = 'elements';

    /**
     * Retourne le mot traduit dans la langue courante.
     * @param string $cle Clé du mot cible.
     * @param array &$session Tableau de session.
     */
    public static function mot(string $cle, array &$session) : ?string
    { return $session[self::INDEX][self::MOTS][$cle] ?? null; }

    /** Clé des langues disponibles. */
    public const DISPONIBLES_INDEX = 'langs';
    /** Clé de la langue courante ou demandée. */
    public const INDEX = 'lang';

    // TODO Définition de la langue par défaut selon la langue demandée par le navigateur du client.
    /** Indice de la langue par défaut. */
    private const PAR_DEFAUT = "fr";

    /**
     * Chargement des langues disponibles dans le tableau de session et depuis le fichier JSON dédié.
     * @param array &$session Tableau de session.
     */
    private static function charger_langues_diponibles(array &$session) : void
    {
        $session[self::DISPONIBLES_INDEX] = json_decode(file_get_contents(
            self::DISPONIBLES_FICHIER
        ), true) ?? [];
    }

    /**
     * Retourne le nom du fichier de traduction associé à une langue.
     * @param string $langue Code de la langue cible.
     * @return string Nom du fichier de traduction.
     */
    private static function fichier_langue(string $code_langue) : string
    { return self::DATA_DOSSIER . $code_langue . '.' . self::DATA_EXT; }

    /**
     * Définition et chargement de la langue à utiliser.
     * @param array &$session Tableau de session.
     * @param array &$get Tableau des arguments GET.
     */
    public static function charger(array &$session, array &$get) : void
    {
        // Chargement des langues si elles ne le sont pas déjà.
        if (!isset($session[self::DISPONIBLES_INDEX])) self::charger_langues_diponibles($session);
        // Si aucune langue définie en session OU qu'un changement de langue est demandé via GET...
        if (!isset($session[self::INDEX]) || isset($get[self::INDEX]))
        {
            $fichier = self::fichier_langue(self::PAR_DEFAUT);
            // Si c'est un changement de langue ET que la langue demandée existe dans le tableau des langues, on procède au changement
            if (isset($get[self::INDEX], $session[self::DISPONIBLES_INDEX][$get[self::INDEX]]))
            {
                $fichier_cible = self::fichier_langue($get[self::INDEX]);
                if (file_exists($fichier_cible)) $fichier = $fichier_cible;
            }
            // Chargement de la langue.
            $session[self::INDEX] = json_decode(file_get_contents($fichier), true) ?? [];
        }
    }
}