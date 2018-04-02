# Schnittstabil\Saika

> SAIKA – Simple All-Inkl KasApi [WIP].


## Install

```
composer global require schnittstabil/saika
```


## Usage

```php
use Schnittstabil\Saika\KasApi;

$api = KasApi::getInstance(getenv('KAS_AUTH_USER'), getenv('KAS_AUTH_PASS'));
```


### Chown

```php
// change owner of /www/htdocs/<...>/.htaccess to getenv('KAS_AUTH_USER')
$api->chown('.htaccess');

// change owner of /www/htdocs/<...>/.htaccess to www-data
$api->chown('.htgroups', $api->getWwwUser());
```


## License

MIT © [Michael Mayer](http://schnittstabil.de)
