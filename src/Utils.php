<?php

namespace App;

class Utils
{
    public static function redirect($path): void
    {
        header('Location:' . $path);
    }

    public static function isSelected(int $nbr): void
    {
        if (isset($_SESSION['nbTeam']) && $_SESSION['nbTeam'] == $nbr) {
            echo ' selected';
        }
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
     * Return a random key of an array. Carefull, transform the array's keys into a 0 starting and auto-increment keys
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

    public static function removeTwoValues(array $array, int $key1, int $key2): array
    {
        // if ($key1 > $key2) {
            array_splice($array, $key1, 1);
            array_splice($array, $key2, 1);
        // } else {
        //     array_splice($array, $key2, 1);
        //     array_splice($array, $key1, 1);
        // }
        return $array;
    }
}
