<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Unit\Dispatcher;

use UnitTester;

/**
 * Class GetNamespaceNameCest
 */
class GetNamespaceNameCest
{
    /**
     * Tests Phalcon\Dispatcher :: getNamespaceName()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function dispatcherGetNamespaceName(UnitTester $I)
    {
        $I->wantToTest('Dispatcher - getNamespaceName()');
        $I->skipTest('Need implementation');
    }
}
