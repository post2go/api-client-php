ParcelGo.ru API client
================================================
[![Build Status](https://travis-ci.org/parcelgo/api-client-php.svg?branch=master)](https://travis-ci.org/parcelgo/api-client-php)

[ParcelGo](http://parcelgo.ru/ "parcelgo.ru") is a shipment tracking service.

```php
$parcelgoClient = new ParcelGoClient\Manager('INSERT YOUR API KEY HERE');

$courier = 'usps';
$trackingNumber = 'EC208786464US';
//detect courier by tracking number
$parcelgoClient->couriers()->detect($trackingNumber);
//get all couriers
$parcelgoClient->couriers()->get();

//add tracking number to parcelgo 
$parcelgoClient->tracking()->create($courier, $trackingNumber);
//get tracking info
$parcelgoClient->tracking()->get($courier, $trackingNumber);
//reactivate tracking number 
$parcelgoClient->tracking()->reactivate($courier, $trackingNumber);

//get last checkpoint info
$parcelgoClient->lastCheckpoint($courier, $trackingNumber);
```

### Installing via Composer

The recommended way to install is through [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add Guzzle as a dependency
php composer.phar require parcelgo/parcelgo-client:~1.0
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```


