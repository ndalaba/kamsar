<?php

/**
 * Class de function d'aide
 *
 * @version    1.0
 * @author    Dev-In
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://development-in.com
 */
class Helper {

     public static function afficherDateRelative($date) { // Affiche la date relative en jours/heures/minutes (methode par balayage);
        // Initialisation
        $secondes = time() - $date;
        $secondes > 1 ? $secondes .= ' secondes' : $secondes .= ' seconde';
        $minutes = '';
        $heures = '';
        $jours = '';

        $dateRelative = 'Il y a ' . $secondes;

        // Début du balayage

        if ($secondes > 60) { // S'il y a plus d'une minute
            $minutes = floor($secondes / 60);
            $minutes > 1 ? $minutes .= ' minutes' : $minutes .= ' minute';
            $secondes = floor($secondes % 60);
            $secondes > 1 ? $secondes .= ' secondes' : $secondes .= ' seconde';

            $dateRelative = 'Il y a ' . $minutes . ' et ' . $secondes;
        }

        if ($minutes > 60) { // S'il y a plus d'une heure
            $heures = floor($minutes / 60);
            $heures > 1 ? $heures .= ' heures' : $heures .= ' heure';
            $minutes = floor($minutes % 60);
            $minutes > 1 ? $minutes .= ' minutes' : $minutes .= ' minute';

            $dateRelative = 'Il y a ' . $heures . ' et ' . $minutes;
        }

        if ($heures > 24) { // S'il y a plus d'un jour
            $jours = floor($heures / 24);
            $jours > 1 ? $jours .= ' jours' : $jours .= ' jour';
            $heures = floor($heures % 24);
            $heures > 1 ? $heures .= ' heures' : $heures .= ' heure';

            $dateRelative = 'Il y a ' . $jours . ' et ' . $heures;
        }

        if ($jours > 7) { // S'il y a plus d'une semaine, on affiche la date normale
            $mois = date("m", $date) - 1;
            $calendrier = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'décembre');

            $jour = date("j", $date);
            $mois = $calendrier[$mois];
            date("Y", $date) != date("Y") ? $annee = date("Y", $date) : $annee = '';

            $dateRelative = 'Le ' . $jour . ' ' . $mois . ' ' . $annee;
        }

        return $dateRelative;
    }
    public static function formatDate($date) {
        $f = explode("-", $date);
        $f = array_reverse($f);
        $format = implode('/', $f);
        return $format;
    }
}
