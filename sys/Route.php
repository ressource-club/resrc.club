<?php

include_once __RACINE__ . 'sys/HTML.php';
include_once __RACINE__ . 'sys/Data.php';

/**
 * Gestion du routage.
 */
abstract class Routeur
{
    /** Route principale faisant office d'index (/). */
    private const INDEX = 'accueil';
    /** Préfixe des routes menant au dossier des données publiques. */
    private const DATA = '/data/';

    /** Dossier contenant les vues relatives aux erreurs. */
    private const ERR_DOSSIER = 'erreur/';
    /** Route d'erreur 404. */
    private const ERR_404 = self::ERR_DOSSIER . '404';

    /**
     * Envoi d'une erreur 404 au client.
     */
    public static function err_404() : void
    { header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404); }

    /**
     * Détermination et chargement du contenu selon l'URI.
     * @param string $uri URI demandé.
     */
    public static function route(string $uri) : void
    {
        $uri = explode('?', $uri, 2)[0]; // On retire les enventuels arguments GET.
        $html = null;
        if ($uri === '/') $html = self::INDEX;
        else if (substr($uri, 0, strlen(self::DATA)) === self::DATA) // Demande de données publiques.
        {
             // Chargement du fichier publique.
            Data::charger(substr($uri, strlen(self::DATA))); 
            return; // On ne chargera pas de page HTML.
        }
        else
        {
            $uri = substr($uri, 1, strlen($uri) - 2); // On retire le premier et dernier /.
            // Si le fichier demandé existe, on utilise l'URI complet.
            if (file_exists(HTML::DOSSIER . $uri . '.' . HTML::EXT)) $html = $uri;
            // Sinon, on déclenche une erreur 404.
            else
            {
                http_response_code(404);
                $html = self::ERR_404;
            }
        }
        // Chargement de la page HTML définie.
        HTML::charger($html);
    }
}