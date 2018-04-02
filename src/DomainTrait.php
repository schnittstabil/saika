<?php

namespace Schnittstabil\Saika;

use SoapClient;
use SoapFault;

trait DomainTrait
{
    /**
     * @return mixed
     * @throws SoapFault
     */
    abstract protected function call(string $kasRequestType, array $kasRequestParams = []);

    /**
     * @param string $domainName
     * @return array
     * @throws SoapFault
     */
    public function getDomains(string $domainName = null) : array
    {
        return $this->call('get_domains', [
            'domain_name' => $domainName,
        ]);
    }

    /**
     * @return array
     * @throws SoapFault
     */
    public function getTopLevelDomains() : array
    {
        return $this->call('get_topleveldomains');
    }
}
