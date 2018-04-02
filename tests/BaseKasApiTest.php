<?php

namespace Schnittstabil\Saika;

use Exception;
use SoapFault;

abstract class BaseKasApiTest extends BaseTest
{
    protected static $api;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        static::$api = KasApi::getInstance(static::$user, static::$pass);
    }
}
