Post2Go API client
================================================
[![Build Status](https://travis-ci.org/post2go/api-client-php.svg?branch=master)](https://travis-ci.org/post2go/api-client-php)

[Post2Go](http://post2go.ru/ "post2go.ru") is a shipment tracking service.

```php
$post2goClient = new Post2GoClient\Manager('INSERT YOUR API KEY HERE');

$courier = 'usps';
$trackingNumber = 'EC208786464US';

//detect courier by tracking number
$post2goClient->couriers()->detect($trackingNumber);
//get all couriers
$post2goClient->couriers()->get();

//add tracking number to post2go 
$post2goClient->tracking()->create($courier, $trackingNumber);
//get tracking info
$post2goClient->tracking()->get($courier, $trackingNumber);
//reactivate tracking number 
$post2goClient->tracking()->reactivate($courier, $trackingNumber);

//get last checkpoint info
$post2goClient->lastCheckpoint($courier, $trackingNumber);
```

See [examples](https://github.com/post2go/api-client-php/tree/master/examples) for more info 
### Installing via Composer

The recommended way to install is through [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add as a dependency
php composer.phar require post2go/post2go-client:dev-master
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```


