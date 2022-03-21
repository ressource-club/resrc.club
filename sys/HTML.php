<?php

/**
 * Gestion du contenu HTML.
 */
abstract class HTML
{
    /** Dossier des fichiers HTML du site. */
    public const DOSSIER = __RACINE__ . 'html/';
    /** Dossier des composants HTML. */
    private const DOSSIER_COMPOSANTS = self::DOSSIER . 'composants/';
    /** Dossier des éléments HTML. */
    private const DOSSIER_ELEMENTS = self::DOSSIER . 'elements/';
    /** Extension des fichiers de vue HTML. */
    public const EXT = 'html';

    /**
     * Chargement et affichage d'une page HTML.
     * @param string $nom Nom de la page à charger.
     */
    public static function charger(string $nom)
    {
        include self::DOSSIER_COMPOSANTS . 'entete.' . self::EXT;
        include self::DOSSIER . $nom . '.' . self::EXT;
        include self::DOSSIER_COMPOSANTS . 'pied.' . self::EXT;
    }
    /**
     * Chargement et affichage d'un élément HTML.
     * @param string $nom Nom de l'élément à charger.
     */
    public static function element(string $nom) : void
    { include self::DOSSIER_ELEMENTS . $nom . '.' . self::EXT; }

    /** Clé du texte associé à un lien. */
    private const LIEN_TEXTE = 'texte';
    /** Clé de l'URL associé à un lien. */
    private const LIEN_URL = 'url';

    /**
     * Affichage d'un lien depuis un tableau issu d'un JSON.
     * @param array &$lien Tableau des informations relatives au lien.
     */
    public static function afficher_lien(array &$lien) : void
    { print('<a href="' . ($lien[self::LIEN_URL] ?? '') . '" target="_blank">' . $lien[self::LIEN_TEXTE] . '</a>'); }
}