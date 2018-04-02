<?php

namespace Schnittstabil\Saika;

use Exception;
use SoapFault;

class ChownTraitTest extends BaseKasApiTest
{
    public function testChownShouldNotFail()
    {
        $this->assertNull(static::$api->chown('usage'));
    }

    public function testTwoTimesChownShouldNotFail()
    {
        $this->assertNull(static::$api->chown('.htaccess'));
        $this->assertNull(static::$api->chown('.htgroups'));
    }
}
