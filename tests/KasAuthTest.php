<?php

namespace Schnittstabil\Saika;

use Exception;
use SoapFault;

class KasAuthTest extends BaseTest
{
    public function testGetCredentialTokenShouldSucceed()
    {
        $sut = new KasAuth(static::$user, static::$pass);
        $credentialToken = $sut->getCredentialToken();

        $this->assertNotEmpty($credentialToken);
        $this->assertInternalType('string', $credentialToken);
    }
}
