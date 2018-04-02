<?php

namespace Schnittstabil\Saika;

use Exception;
use SoapFault;

class DomainTraitTest extends BaseKasApiTest
{
    public function testGetDomainsShouldReturnArray()
    {
        $domains = static::$api->getDomains();
        $this->assertInternalType('array', $domains);
    }

    public function testGetTopLevelDomainsShouldReturnNotEmptyArray()
    {
        $tlds = static::$api->getTopLevelDomains();
        $this->assertNotEmpty($tlds);
    }
}
