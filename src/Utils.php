<?php

namespace App;

class Utils
{
    public static function redirect($path): void
    {
        header('Location:' . $path);
    }

    /**
     * Checks if the tournament's number of teams in Session corresponds to the number entered in parameter. 
     *
     * @param integer $nbr
     * @return bool
     */
    public static function isSelected(int $nbr): bool
    {
        return (isset($_SESSION['nbTeam']) && $_SESSION['nbTeam'] == $nbr); 
    }

    /**
     * return if a number is a power of 2 or not, except 2 power 0.
     *
     * @param integer $nbr
     * @return boolean
     */
    public static function isPowerOfTwo(int $nbr): bool
    {       // on divise par 2 le nombre jusqu'à ce qu'il tombe sur 2 (dans ce cas il est bien une puissance de 2), ou en dessous (dans ce cas il ne l'est pas)
        while ($nbr > 2) {
            $nbr = $nbr / 2;
        }

        return ($nbr === 2);
    }

    public static function killSession(): void
    {
        session_start();
        $_SESSION = [];
        session_destroy();
    }
    
    /**
     * Return a random key of an array. Carefull, transform the array's keys into a 0 starting and increment keys
     *
     * @param array $array
     * @return integer
     */
    public static function randomArrayKey(array $array): int
    {
        array_values($array);
        $keyMax = count($array) - 1;
        return round(rand(0, $keyMax));
    }

    /**
     * delete 2 values of an array thanks to their keys. returns an array with increment keys starting at 0
     *
     * @param array $array
     * @param integer $key1
     * @param integer $key2
     * @return array
     */
    public static function removeTwoValues(array $array, int $key1, int $key2): array
    {
        // On supprime les 2 valeurs et les 2 clés :
        unset($array[$key1]);
        unset($array[$key2]);
        // On reforme le tableau pour reset les clés en partant de 0
        $array = array_values($array);
        return $array;
    }
}
