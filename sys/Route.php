<?php

/**
 * Gestion du routage.
 */
abstract class Routeur
{
    /** Route principale faisant office d'index (/). */
    private const INDEX = 'accueil';

    /** Dossier contenant les vues relatives aux erreurs. */
    private const ERR_DOSSIER = 'erreur/';
    /** Route d'erreur 404. */
    private const ERR_404 = self::ERR_DOSSIER . '404';
    /** En-tête HTTP relative à une erreur 404. */
    private const ERR_404_ENTETE = "HTTP/1.1 404 Not Found";

    /**
     * Détermination du fichier HTML à charger selon l'URI.
     * @param string $uri URI demandé.
     * @return string Route.
     */
    public static function definir_route(string $uri) : string
    {
        $uri = explode('?', $uri, 2)[0]; // On retire les enventuels arguments GET.
        switch ($uri)
        {
        case '/':
            return self::INDEX;
        default:
            $uri = substr($uri, 1, strlen($uri) - 2); // On retire le premier et dernier /.
            // Si le fichier demandé existe, on renvoi l'URI complet.
            if (file_exists(HTML::DOSSIER . $uri . '.' . HTML::EXT)) return $uri;
            // Sinon, on déclenche une erreur 404.
            header(self::ERR_404_ENTETE);
            return self::ERR_404;
        }
    }
}