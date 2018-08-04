<?php

namespace Drinks;

/**
 * Coca cola drink
 *
 * @author Ersin Güvenç
 */
class CocaCola implements DrinkInterface 
{
	protected $cl;

	/**
	 * Constructor
	 * 
	 * @param string $cl litre
	 */
    public function __construct($cl = '33')
    {
    	$this->cl = '33';
    }
}