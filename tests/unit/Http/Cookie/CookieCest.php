<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Unit\Http\Cookie;

use Phalcon\Http\Cookie;
use Phalcon\Http\Cookie\Exception;
use Phalcon\Http\Response\Cookies;
use Phalcon\Test\Fixtures\Traits\CookieTrait;
use Phalcon\Test\Unit\Http\Helper\HttpBase;
use UnitTester;

class CookieCest extends HttpBase
{
    use CookieTrait;

    /**
     * executed before each test
     */
    public function _before(UnitTester $I)
    {
        parent::_before($I);
        $this->setDiSessionFiles();
    }

    /**
     * Tests Cookie::getValue using message authentication code and request
     * forgery
     *
     * @test
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-05-06
     */
    public function shouldThrowExceptionIfMessageAuthenticationCodeIsMismatch(UnitTester $I)
    {
        /**
         * TODO: Check the exception
         */
        $I->skipTest('TODO: Check the exception');
        $I->checkExtensionIsLoaded('xdebug');

        $I->expectThrowable(
            new Exception("Hash does not match."),
            function () use ($I) {
                $this->setDiCrypt();
                $container = $this->getDi();

                $cookieName  = 'test-signed-name1';
                $cookieValue = 'test-signed-value';

                $cookie = new Cookie($cookieName, $cookieValue, time() + 3600);

                $cookie->setDI($container);
                $cookie->useEncryption(true);
                $cookie->setSignKey('12345678901234567890123456789012');

                $cookie->send();

                $I->setProtectedProperty($cookie, '_readed', false);

                $rawCookie = $this->getCookie($cookieName);
                $rawValue  = explode(';', $rawCookie)[0];

                $originalValue = mb_substr($rawValue, 64);

                $_COOKIE[$cookieName] = str_repeat('X', 64) . $originalValue;
                $cookie->getValue();
            }
        );
    }

    /**
     * Tests Cookie::getValue using message authentication code
     *
     * @test
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-05-06
     */
    public function shouldDecryptValueByUsingMessageAuthenticationCode(UnitTester $I)
    {
        $I->checkExtensionIsLoaded('xdebug');

        $this->setDiCrypt();
        $container = $this->getDi();

        $cookieName  = 'test-signed-name2';
        $cookieValue = 'test-signed-value';

        $cookie = new Cookie($cookieName, $cookieValue, time() + 3600);

        $cookie->setDI($container);
        $cookie->useEncryption(true);
        $cookie->setSignKey('12345678901234567890123456789012');

        $cookie->send();

        $I->setProtectedProperty($cookie, '_readed', false);

        $rawCookie = $this->getCookie($cookieName);
        $rawValue  = explode(';', $rawCookie)[0];

        $_COOKIE[$cookieName] = $rawValue;
        $expected             = $cookieValue;
        $actual               = $cookie->getValue();
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Cookie::getValue with using encryption and default crypt algo.
     *
     * @test
     * @issue  https://github.com/phalcon/cphalcon/issues/11259
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2017-10-04
     */
    public function shouldDecryptValueByUsingDefaultEncryptionAlgo(UnitTester $I)
    {
        $this->setDiCrypt();
        $container = $this->getDi();

        $cookie = new Cookie('test-cookie', 'test', time() + 3600);
        $cookie->setDI($container);
        $cookie->useEncryption(true);

        $expected = 'test';
        $actual   = $cookie->getValue();
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests the internal cookies property.
     *
     * @test
     * @issue  https://github.com/phalcon/cphalcon/issues/12978
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2017-09-02
     */
    public function shouldWorkWithoutInitializeInternalCookiesProperty(UnitTester $I)
    {
        $cookies = new Cookies();
        $actual  = $cookies->send();
        $I->assertTrue($actual);
    }
}
