<?php

/**
 * Fridge interface
 *
 * @author Ersin Güvenç
 */
interface FridgeInterface
{
     /**
     * Put drink(s) to fridge
     * 
     * @param  array  $drinks drinks
     * @return void
     */
    public function put(array $drinks);

    /**
     * Returns to array of drink object(s)
     * 
     * @param  int    $requestedNumber number of drinks
     * @return array
     */
    public function get(int $requestedNumber) : array;
}
