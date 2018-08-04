<?php

use Drinks\DrinkInterface;

/**
 * Each shelf is able to get max 20 drinks.
 *
 * @author Ersin Güvenç
 */
class Shelf implements ShelfInterface
{
    protected $stack = array();

    /**
     * Add one drink
     *
     * @param $object drink
     * @return void
     */
    public function unshift($drink)
    {
        $this->stack[] = $drink;
    }

    /**
     * Get one drink
     * 
     * @return object
     */
    public function shift() : DrinkInterface
    {
        return array_pop($this->stack);
    }

    /**
     * Returns to total of drinks
     * 
     * @return integer
     */
    public function count() : int
    {
        return count($this->stack);
    }
}