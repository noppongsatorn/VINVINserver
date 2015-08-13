<?php

require_once 'vendor/autoload.php';

use Sly\NotificationPusher\PushManager,
    Sly\NotificationPusher\Adapter\Apns as ApnsAdapter,
    Sly\NotificationPusher\Collection\DeviceCollection,
    Sly\NotificationPusher\Model\Device,
    Sly\NotificationPusher\Model\Message,
    Sly\NotificationPusher\Model\Push
;

// First, instantiate the manager.
//
// Example for production environment:
// $pushManager = new PushManager(PushManager::ENVIRONMENT_PRODUCTION);
//
// Development one by default (without argument).
$pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);

// Then declare an adapter.
$apnsAdapter = new ApnsAdapter(array(
    'certificate' => 'cer/Certificates.pem',
));

// Set the device(s) to push the notification to.
$devices = new DeviceCollection(array(
    new Device('1dbf2cf3bce3a40c6f4e8a19b9ce127553d0409b114c26e2dfd90a27720e66ed'),  //Nop iPhone 
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('3362cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091499'),  //random
    new Device('2262cd42ec2fafdef5ebc996d98823aa2430997882d0dabccb1ae94fc6091415'),  //Nop iPad 
    // ...
));

// Then, create the push skel.
$message = new Message('Vin driver arrived.');

// Finally, create and add the push to the manager, and push it!
$push = new Push($apnsAdapter, $devices, $message);
$pushManager->add($push);
$pushManager->push();





?>