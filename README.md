# moneybird-com-php-api
A PHP library for the http://moneybird.com API.
## MoneyBird v1
Version 2 of MoneyBird is not yet available to all of their customers. Please make sure, when using this library that
you are using version 2 of MoneyBird. You can check that quite easy: version 1 is using http://moneybird.nl, version 2
http://moneybird.com (notice .nl vs. .com). A library for version 1 is available: 
https://github.com/youngguns-nl/moneybird_php_api. This library is not compatible with the library of version 1. With
introducing version 2, MoneyBird changed the API in such way that compatibility is hard to maintain.
## Synopsis
This library is created to ease the use of the http://moneybird.com API. Authentication can be done using either an API
key or an OAuth client (which needs a token and secret). The client in this library assumes authentication using an API
key. This key can be requested using the http://moneybird.com web application (user, developer section). Connecting to
http://moneybird.com using this library can be done as well using OAuth, use the `$client` parameter of the constructor.
Make sure that you use a client that acts like the client in this library. If you have a client library available,
please add a link to that library in the section OAuth clients. 
## Code example
The following example shows how to use the library using API-token authentication to retrieve all sales invoices.

```php
$salesInvoiceFactory = new SalesInvoiceFactory('123', null, 'abc');
$salesInvoiceFactory->listAll();
```
And this example shows how to use the library using your own client. See OAuth client section for more information.
```php
$client = new MoneyBirdOAuth();
$salesInvoiceFactory = new SalesInvoiceFactory('123', $client);
$salesInvoiceFactory->listAll();
```
In the examples above, '123' corresponds to the administration identifier, 'abc' to the API token. Please replace with
real values.
## Motivation
This library has been written in the first place to link http://moneybird.com to other systems an our own software.
## Installation
This library has not yet been added as a repository for composer. Just download this library and put it in the vendor
directory of your project. Make sure you add a reference to the autoload section of your composer. Adding this project
to composer will be done as soon as possible.
## License
This library is available under the MIT License (MIT), see LICENSE for more information.
## OAuth clients
- Yii2 OAuth 2.0 MoneyBird: https://github.com/EmileBons/yii2-oauth2-moneybird-com

## Documentation
Documentation of the http://moneybird.com API is available at http://developer.moneybird.com.