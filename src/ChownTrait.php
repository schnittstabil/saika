<?php

namespace Schnittstabil\Saika;

use SoapClient;
use SoapFault;

trait ChownTrait
{
    /**
     * @return string
     */
    abstract protected function getUser() : string;

    /**
     * @return mixed
     * @throws SoapFault
     */
    abstract protected function call(string $kasRequestType, array $kasRequestParams = []);

    /**
     * @param string  $file      resolves to `'/www/htdocs/'.$this->getUser().'/'.$file`
     * @param string  $owner     defaults to `$this->getUser()`
     * @param boolean $recursive
     * @return void
     * @throws SoapFault
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function chown(string $file, string $owner = null, bool $recursive = false) : void
    {
        if ($owner === null) {
            $owner = $this->getUser();
        }

        $this->call('update_chown', [
            'chown_path' => $file,
            'chown_user' => $owner,
            'recursive' => $recursive ? 'Y' : 'N',
        ]);
    }
}
