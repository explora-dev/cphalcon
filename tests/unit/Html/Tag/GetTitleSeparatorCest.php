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

namespace Phalcon\Test\Unit\Html\Tag;

use Phalcon\Html\Tag;
use UnitTester;

/**
 * Class GetTitleSeparatorCest
 *
 * @package Phalcon\Test\Unit\Html\Tag
 */
class GetTitleSeparatorCest
{
    /**
     * Tests Phalcon\Html\Tag :: getTitleSeparator()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function htmlTagGetTitleSeparator(UnitTester $I)
    {
        $I->wantToTest('Html\Tag - getTitleSeparator()');
        $tag = new Tag();

        $actual = $tag->getTitleSeparator();
        $I->assertEmpty($actual);

        $separator = '--::--';
        $tag->setTitleSeparator($separator);
        $actual = $tag->getTitleSeparator();
        $I->assertEquals($separator, $actual);
    }
}
