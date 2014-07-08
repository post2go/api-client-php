<?php
require_once __DIR__ . '/../vendor/autoload.php';

$parcelgoClient = new ParcelGoClient\Manager('INSERT YOUR API KEY HERE');

$courier = 'usps';
$trackingNumber = 'EC208786464US';
$parcelgoClient->couriers()->detect($trackingNumber);
$parcelgoClient->couriers()->get();

$parcelgoClient->tracking()->create($courier, $trackingNumber);
$parcelgoClient->tracking()->get($courier, $trackingNumber);
$parcelgoClient->tracking()->reactivate($courier, $trackingNumber);

$parcelgoClient->lastCheckpoint($courier, $trackingNumber);