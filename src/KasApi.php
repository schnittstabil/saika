<?php

namespace Schnittstabil\Saika;

use SoapClient;
use SoapFault;

/**
 * all-inkl KasApi
 */
class KasApi
{
    use ChownTrait;
    use DomainTrait;

    /**
     * @var KasAuth
     */
    protected $kasauth;

    /**
     * @var SoapClient
     */
    protected $soapClient;

    /**
     * (Not Before) The time before which the next SOAP Request MUST NOT be send.
     * @var float
     */
    protected $nbf = 0;

    public function __construct(KasAuth $kasauth, SoapClient $soapClient = null)
    {
        if ($soapClient === null) {
            $soapClient = new SoapClient('https://kasapi.kasserver.com/soap/wsdl/KasApi.wsdl');
        }

        $this->kasAuth = $kasauth;
        $this->soapClient = $soapClient;
    }

    public static function getInstance(string $user, string $pass) : self
    {
        return new static(new KasAuth($user, $pass));
    }

    /**
     * @return string
     */
    public function getUser() : string
    {
        return $this->kasAuth->getUser();
    }

    /**
     * @return string
     */
    public function getWwwUser() : string
    {
        return 'www-data';
    }

    /**
     * @param string $kasRequestType
     * @param array $kasRequestParams
     * @return mixed
     * @throws SoapFault
     */
    protected function call(string $kasRequestType, array $kasRequestParams = [])
    {
        $wait = $this->nbf - microtime(true);
        if ($wait > 0) {
            sleep(ceil($wait));
        }

        $result = $this->soapClient->KasApi(json_encode([
            'KasUser' => $this->kasAuth->getUser(),
            'KasAuthType' => 'session',
            'KasAuthData' => $this->kasAuth->getCredentialToken(),
            'KasRequestType' => $kasRequestType,
            'KasRequestParams' => $kasRequestParams,
        ]));
        $this->nbf = $result['Response']['KasFloodDelay'] + microtime(true);

        return $result['Response']['ReturnInfo'];
    }
}
