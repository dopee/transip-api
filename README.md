Wrapper of the transip API


###Symfony2
Do you want to use the TransIp API in your symfony2 project?

https://github.com/dopee/transip-api-bundle

Installation
============

composer.json
```json
"require": {
  ...
  "dopee/transip-api": "1.1.0"
}
```

Run `composer update verschoof/transip-api-bundle`

Usage
======

```php
$login      = ''; // Your login at transip
$privateKey = ''; // Your key from transip

$client = new Transip\Client($login, $privateKey, true);

$domainApi  = $client->api('domain');
$domainInfo = $domainApi->getInfo('domain.com'); 
// This returns an exception if the domain cannot be found !
// So it might be wise to do it in a try catch instruction
$status = $domainApi->checkAvailability(); 
// returns the string FREE if the domain is available
```

TransIp API documentation:
==========================

https://api.transip.nl/docs/transip.nl/
