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

namespace Phalcon\Test\Integration\Mvc\View\Simple;

use IntegrationTester;

/**
 * Class GetActiveRenderPathCest
 */
class GetActiveRenderPathCest
{
    /**
     * Tests Phalcon\Mvc\View\Simple :: getActiveRenderPath()
     *
     * @param IntegrationTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function mvcViewSimpleGetActiveRenderPath(IntegrationTester $I)
    {
        $I->wantToTest('Mvc\View\Simple - getActiveRenderPath()');
        $I->skipTest('Need implementation');
    }
}
