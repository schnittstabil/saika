<?php

namespace Schnittstabil\Saika;

use Exception;
use SoapFault;

class KasApiTest extends BaseTest
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testGetWwwUserShouldReturnWwwData()
    {
        $api = KasApi::getInstance(static::$user, static::$pass);
        $wwwUser = $api->getWwwUser();
        $this->assertSame('www-data', $wwwUser);
    }

    public function testGetUserShouldReturnKasUser()
    {
        $auth = new KasAuth(static::$user, static::$pass);
        $api = new KasApi($auth);
        $kasUser = $api->getUser();
        $this->assertSame(static::$user, $kasUser);
    }
}
