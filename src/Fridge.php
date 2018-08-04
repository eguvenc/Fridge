<?php

use Exception\{
    FullException,
    EmptyException,
    NotAllowedException,
};
use Drinks\DrinkInterface;

/**
 * Fridge class to add drinks
 *
 * @author Ersin Güvenç
 */
class Fridge implements FridgeInterface
{
    /**
     * Shelfs of fridge
     * 
     * @var array
     */
    protected $shelfs = array();

    /**
     * Current shelf number
     * 
     * @var integer
     */
    protected $current = 0;

    /**
     * Shelf capacity
     * 
     * @var integer
     */
    protected $shelfCapacity = 2;

    /**
     * Fridge capacity
     * 
     * @var integer
     */
    protected $fridgeCapacity = 6;

    /**
     * Our fridge has three shelf
     */
    public function __construct()
    {
        $this->shelfs[0] = new Shelf;
        $this->shelfs[1] = new Shelf;
        $this->shelfs[2] = new Shelf;
    }

    /**
     * Set shelf capacity
     * 
     * @param int $max number
     */
    public function setShelfCapacity(int $max)
    {
        $this->shelfCapacity = $max;
    }

    /**
     * Set fridge capacity
     * 
     * @param int $max number
     */
    public function setFridgeCapacity(int $max)
    {
        $this->fridgeCapacity = $max;
    }

    /**
     * Returns to max shelf capacity
     * 
     * @return int
     */
    public function getShelfCapacity() : int
    {
        return $this->shelfCapacity;
    }

    /**
     * Returns to max fridge capacity
     * 
     * @return int
     */
    public function getFridgeCapacity() : int
    {
        return $this->fridgeCapacity;
    }

    /**
     * Check shelf is empty
     * 
     * @return boolean
     */
    public function isEmpty()
    {
        return ($this->shelfs[0]->count() == 0) ? true : false;
    }

    /**
     * Check shelf is full
     * 
     * @return boolean
     */
    public function isFull()
    {
        return ($this->getNumberOfAvailableForGet() == $this->getFridgeCapacity()) ? true : false;
    }

    /**
     * Returns to available drinks count
     * 
     * @return int
     */
    public function getNumberOfAvailableForGet()
    {
        return ($this->shelfs[0]->count() + $this->shelfs[1]->count() + $this->shelfs[2]->count());
    }

    /**
     * Returns to available empty drinks count
     * 
     * @return int
     */
    public function getNumberOfAvailableForPut() : int
    {
        return ($this->getFridgeCapacity() - $this->getNumberOfAvailableForGet());
    }

    /**
     * Put drink(s) to fridge
     * 
     * @param  array  $drinks drinks
     * @return void
     */
    public function put(array $drinks)
    {
        $requestedNumber = count($drinks);
        $availableItemsForPut = $this->getNumberOfAvailableForPut();

        if ($requestedNumber > $availableItemsForPut) {
            throw new NotAllowedException(
                sprintf(
                    'Only %d drinks is available to put, but you requested %d.',
                    $availableItemsForPut,
                    $requestedNumber
                )
            );
        }
        foreach ($drinks as $drink) {
            $this->putOne($drink);
        }
    }

    /**
     * Returns to array of drink object(s)
     * 
     * @param  int    $requestedNumber number of drinks
     * @return array
     */
    public function get(int $requestedNumber) : array
    {
        if ($this->isEmpty()) {
            throw new EmptyException('Fridge is empty. You need to put some drinks.');
        }      
        $availableItemsForGet = $this->getNumberOfAvailableForGet();

        if ($requestedNumber > $availableItemsForGet) {
            throw new NotAllowedException(
                sprintf(
                    'Only %d drinks is available to get, but you requested %d.',
                    $availableItemsForGet,
                    $requestedNumber
                )
            );
        }
        $drinks = array();
        for ($i=1;$i<=$requestedNumber;$i++) {
            $drinks[] = $this->getOne();
        }
        return $drinks;
    }

    /**
     * Put one drink to fridge
     * 
     * @param  object $drink one drink
     * @return boolean true or false
     * @throws Exception
     */
    protected function putOne(DrinkInterface $drink)
    {
        $this->shelfs[$this->current]->unshift($drink);
        
        if ($this->isFull()) {
            return;
        }
        if ($this->shelfs[$this->current]->count() == $this->getShelfCapacity()) {
            $this->current = $this->current + 1;
        }
    }
    
    /**
     * Get one drink from fridge
     *
     * @return object of drink
     * @throws Exception
     */
    protected function getOne() : DrinkInterface
    {
        if ($this->shelfs[$this->current]->count() == 0) {
            $this->current = $this->current - 1;
        }
        $drink = $this->shelfs[$this->current]->shift();

        return $drink;
    }
}