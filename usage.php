#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use Schnittstabil\Saika\KasApi;

$api = KasApi::getInstance(getenv('KAS_AUTH_USER'), getenv('KAS_AUTH_PASS'));

// change owner to getenv('KAS_AUTH_USER')
$api->chown('.htaccess');

// change owner to www-data
$api->chown('.htgroups', $api->getWwwUser());
