
# Fridge Sınıfı

> 3 raflı içececek dolabı sınıfı.

## Kurulum

``` bash
$ git clone http://github.com/eguvenc/Fridge Fridge
```

Projeyi fridge klasörü altındaki index.php dosyasından çalıştırabilirsiniz.

```
http://fridge/index.php
```

## Gereksinimler

Bu proje aşağıdaki php versiyonlarını tarafından desteklenir.

* 7.0
* 7.1
* 7.2

## Çalıştırma

Raf kapasitesi 20 ve buzdolabı kapasitesi 60 olarak girilmelidir.

```php
require 'autoload.php';

use Drinks\CocaCola;

$fridge = new Fridge;
$fridge->setShelfCapacity(20);
$fridge->setFridgeCapacity(20 * 3);
```

Birden fazla içecek koyulabilir veya alınabilir.

```php
try {

    $fridge->put(
        [
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
        ]
    );
    $drinks = $fridge->get(6);

    echo '<pre>';
    print_r($drinks);
    echo '</pre>';

} catch (Exception $e) {
    echo '<b>'.get_class($e).'</b> : '.$e->getMessage();
}
```

## Testler

Doluluk ve boşluk durumları

```php
require 'autoload.php';

use Drinks\CocaCola;

$fridge = new Fridge;
$fridge->setShelfCapacity(2);
$fridge->setFridgeCapacity(2 * 3);
```

### Buzdolabı boş ise.


```php
try {
    $drinks = $fridge->get(6);

    echo '<pre>';
    print_r($drinks);
    echo '</pre>';

} catch (Exception $e) {
    echo '<b>'.get_class($e).'</b> : '.$e->getMessage();
}
```

> Exception\EmptyException : Fridge is empty. You need to put some drinks.


### Buzdolabı tamamen dolu ise, 6 kapasite için 7 ürün ekledik.


```php
try {
    $fridge->put(
        [
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
            new CocaCola('33'),
        ]
    );
} catch (Exception $e) {
    echo '<b>'.get_class($e).'</b> : '.$e->getMessage();
}
```

> Exception\NotAllowedException : Only 6 drinks is available to put, but you requested 7.


### Buzdolabı kısmen dolu ise, 6 kapasite için 5 ürün ekledik, 4 tane aldık

```php
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
```

Çıktı

```
Kalan Yer:1

Array
(
    [0] => Drinks\CocaCola Object
        (
            [cl:protected] => 33
        )

    [1] => Drinks\CocaCola Object
        (
            [cl:protected] => 33
        )

    [2] => Drinks\CocaCola Object
        (
            [cl:protected] => 33
        )

    [3] => Drinks\CocaCola Object
        (
            [cl:protected] => 33
        )

)

Kalan Yer:5
Verilen İçecek:4
Kalan İçecek:1
```