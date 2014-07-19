<?php
require_once __DIR__ . '/../vendor/autoload.php';

$parcelgoClient = new ParcelGoClient\Manager('INSERT YOUR API KEY HERE');

$courier = 'usps';
$trackingNumber = 'EC208786464US';
$couriersResponse = $parcelgoClient->couriers()->detect($trackingNumber)->getCouriers();
// list detected couriers
foreach ($couriersResponse as $courier) {
    echo $courier->getCountryCode() . ' ' . $courier->getName() . "\n";;
};

$couriersResponse = $parcelgoClient->couriers()->get()->getCouriers();
//list of all supported couriers
foreach ($couriersResponse as $courier) {
    echo $courier->getCountryCode() . ' ' . $courier->getName() . "\n";;
};

//add tracking number to parcelgo for tracking
$track = $parcelgoClient->tracking()->create($courier, $trackingNumber);

//get tracking info
$trackInfo = $parcelgoClient->tracking()->get($courier, $trackingNumber);
echo $trackInfo->getLastCheck()->format('Y-m-d H:i:s') . "\n";;

foreach ($trackInfo->getCheckpoints() as $checkpoint) {
    echo $checkpoint->getCountryCode() . ' ' . $checkpoint->getLocation() . ' ' . $checkpoint->getTime() . ' '
        . $checkpoint->getStatus() . ' ' . $checkpoint->getMessage() . "\n";
};

//reactivate tracking number
$parcelgoClient->tracking()->reactivate($courier, $trackingNumber);

//get last checkpoint of tracking number
$checkpoint = $parcelgoClient->lastCheckpoint()->get($courier, $trackingNumber)->getCheckpoint();
echo $checkpoint->getCountryCode() . "\n";
echo $checkpoint->getTime() . "\n";
echo $checkpoint->getLocation() . "\n";
echo $checkpoint->getCourierSlug() . "\n";
echo $checkpoint->getMessage() . "\n";
echo $checkpoint->getStatus() . "\n";

