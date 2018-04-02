<?php

namespace Schnittstabil\Saika;

use SoapClient;
use SoapFault;

/**
 * all-inkl KasAuth
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class KasAuth
{
    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $sha1pass;

    /**
     * @var int
     */
    protected $sessionLifetime = 600;

    /**
     * @var bool
     */
    protected $sessionUpdateLifetime = true;

    /**
     * @var SoapClient
     */
    protected $soapClient;

    /**
     * @var string
     */
    protected $credentialToken;

    /**
     * @param string $user KAS-Login
     * @param string $pass KAS-Password
     * @param SoapClient $soapClient defaults to new SoapClient('https://kasapi.kasserver.com/soap/wsdl/KasAuth.wsdl')
     */
    public function __construct(string $user, string $pass, SoapClient $soapClient = null)
    {
        if ($soapClient === null) {
            $soapClient = new SoapClient('https://kasapi.kasserver.com/soap/wsdl/KasAuth.wsdl');
        }

        $this->user = $user;
        $this->sha1pass = sha1($pass);
        $this->soapClient = $soapClient;
    }

    public function getUser() : string
    {
        return $this->user;
    }

    /**
     * @return string
     * @throws SoapFault
     */
    public function getCredentialToken() : string
    {
        if ($this->credentialToken === null) {
            $this->credentialToken = $this->soapClient->KasAuth(json_encode([
                'KasUser' => $this->user,
                'KasAuthType' => 'sha1',
                'KasPassword' => $this->sha1pass,
                'SessionLifeTime' => $this->sessionLifetime,
                'SessionUpdateLifeTime' => $this->sessionUpdateLifetime ? 'Y' : 'N',
            ]));
        }

        return $this->credentialToken;
    }
}
