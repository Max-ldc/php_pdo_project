<?php

/**
 * return if a number is a power of 2 or not, except 2 power 0.
 *
 * @param integer $nbr
 * @return boolean
 */
function isPowerOfTwo(int $nbr) : bool    
{       // on divise par 2 le nombre jusqu'à ce qu'il tombe sur 2 (dans ce cas il est bien une puissance de 2), ou en dessous (dans ce cas il ne l'est pas)
    while ($nbr > 2) {
        $nbr = $nbr/2;
    }

    return ($nbr === 2);
}