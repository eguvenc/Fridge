<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// -------------------------------------------------------------------
// Fridge Package
// -------------------------------------------------------------------
//
require 'autoload.php';

use Drinks\CocaCola;

$fridge = new Fridge;
$fridge->setShelfCapacity(2);
$fridge->setFridgeCapacity(2 * 3);

try {

	$fridge->put(
		[
			new CocaCola('33'),
			new CocaCola('33'),
			new CocaCola('33'),
			new CocaCola('33'),
			new CocaCola('33'),
		]
	);

	echo 'Kalan Yer:' . $fridge->getNumberOfAvailableForPut().'<br />';

	$drinks = $fridge->get(4);

	echo '<pre>';
	print_r($drinks);
	echo '</pre>';

	echo 'Kalan Yer:' . $fridge->getNumberOfAvailableForPut().'<br />';
	echo 'Verilen İçecek:'.count($drinks).'<br />';
	echo 'Kalan İçecek:' . $fridge->getNumberOfAvailableForGet().'<br />';

} catch (Exception $e) {
	echo '<b>'.get_class($e).'</b> : '.$e->getMessage();
}