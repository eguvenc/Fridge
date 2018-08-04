<?php

use Drinks\DrinkInterface;

interface ShelfInterface
{
    /**
     * Add one drink
     *
     * @param $object drink
     * @return void
     */
    public function unshift($drink);

    /**
     * Get one drink
     * 
     * @return object
     */
    public function shift() : DrinkInterface;

    /**
     * Returns to total of drinks
     * 
     * @return integer
     */
    public function count() : int;
}