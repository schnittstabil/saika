<?php

namespace Schnittstabil\Saika;

use Exception;
use SoapFault;

abstract class BaseTest extends \PHPUnit\Framework\TestCase
{
    protected static $user;
    protected static $pass;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function setUpBeforeClass()
    {
        $env = parse_ini_file(__DIR__ . '/../.env', false, INI_SCANNER_RAW & INI_SCANNER_TYPED);
        static::$user = $env['KAS_AUTH_USER'];
        static::$pass = $env['KAS_AUTH_PASS'];
    }
}
