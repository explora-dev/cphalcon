<?php

namespace Phalcon\Test\Integration\Mvc\Model;

use Phalcon\Di;
use IntegrationTester;
use Codeception\Example;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Test\Models\Robots;
use Phalcon\Test\Models\People;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Test\Models\Personas;
use Phalcon\Db\Adapter\Pdo\Sqlite;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Db\Adapter\Pdo\Postgresql;
use Phalcon\Mvc\Model\MetaData\Memory;

class CriteriaCest
{
    /**
     * Executed before each test
     *
     * @param IntegrationTester $I
     */
    public function _before(IntegrationTester $I)
    {
        $I->haveServiceInDi('modelsManager', Manager::class, true);
        $I->haveServiceInDi('modelsMetadata', Memory::class, true);

        Di::setDefault($I->getApplication()->getDI());
    }

    /**
     * Tests creating builder from criteria
     *
     * @author Serghei Iakovlev <serghei@phalconphp.com>
     * @since  2017-05-21
     *
     * @param IntegrationTester $I
     */
    public function createBuilderFromCriteria(IntegrationTester $I)
    {
        $criteria = Robots::query()->where("type='mechanical'");
        $I->assertInstanceOf(Builder::class, $criteria->createBuilder());
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function where(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()->where("estado='I'")->execute();
        $people = People::find("estado='I'");

        $I->assertEquals(count($personas->toArray()), count($people->toArray()));
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function conditions(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()->conditions("estado='I'")->execute();
        $people = People::find("estado='I'");

        $I->assertEquals(count($personas->toArray()), count($people->toArray()));
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function whereOrderBy(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()
            ->where("estado='A'")
            ->orderBy("nombres")
            ->execute();

        $people = People::find(["estado='A'", "order" => "nombres"]);

        $I->assertEquals(count($personas->toArray()), count($people->toArray()));

        $somePersona = $personas->getFirst();
        $somePeople = $people->getFirst();

        $I->assertEquals($somePersona->cedula, $somePeople->cedula);
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function whereOrderByLimit(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()
            ->where("estado='A'")
            ->orderBy("nombres")
            ->limit(100)
            ->execute();

        $people = People::find([
            "estado='A'",
            "order" => "nombres",
            "limit" => 100,
        ]);

        $I->assertEquals(count($personas->toArray()), count($people->toArray()));

        $somePersona = $personas->getFirst();
        $somePeople = $people->getFirst();

        $I->assertEquals($somePersona->cedula, $somePeople->cedula);
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function bindParamsWithLimit(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()
            ->where("estado=?1")
            ->bind([1 => "A"])
            ->orderBy("nombres")
            ->limit(100)
            ->execute();

        $people = People::find([
            "estado=?1",
            "bind"  => [1 => "A"],
            "order" => "nombres",
            "limit" => 100,
        ]);

        $I->assertEquals(count($personas->toArray()), count($people->toArray()));

        $somePersona = $personas->getFirst();
        $somePeople = $people->getFirst();

        $I->assertEquals($somePersona->cedula, $somePeople->cedula);
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function limitWithOffset(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()
            ->where("estado=?1")
            ->bind([1 => "A"])
            ->orderBy("nombres")
            ->limit(100, 10)
            ->execute();

        $people = People::find([
            "estado=?1",
            "bind"  => [1 => "A"],
            "order" => "nombres",
            "limit" => ['number' => 100, 'offset' => 10],
        ]);

        $I->assertEquals(count($personas->toArray()), count($people->toArray()));

        $somePersona = $personas->getFirst();
        $somePeople = $people->getFirst();

        $I->assertEquals($somePersona->cedula, $somePeople->cedula);
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function bindOrderLimit(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()
            ->where("estado=:estado:")
            ->bind(["estado" => "A"])
            ->orderBy("nombres")
            ->limit(100)
            ->execute();

        $people = People::find([
            "estado=:estado:",
            "bind"  => ["estado" => "A"],
            "order" => "nombres",
            "limit" => 100,
        ]);

        $I->assertEquals(count($personas->toArray()), count($people->toArray()));

        $somePersona = $personas->getFirst();
        $somePeople = $people->getFirst();

        $I->assertEquals($somePersona->cedula, $somePeople->cedula);
    }

    /**
     * @param IntegrationTester $I
     * @param Example $example
     *
     * @dataprovider adapterProvider
     */
    public function orderBy(IntegrationTester $I, Example $example)
    {
        $di = Di::getDefault();
        $di->setShared('db', $example['adapter']);

        $personas = Personas::query()->orderBy("nombres");

        $I->assertEquals($personas->getOrderBy(), "nombres");
    }

    protected function adapterProvider()
    {
        return [
            [
                'adapter' => new Mysql([
                    'host'     => env('TEST_DB_MYSQL_HOST', '127.0.0.1'),
                    'username' => env('TEST_DB_MYSQL_USER', 'root'),
                    'password' => env('TEST_DB_MYSQL_PASSWD', ''),
                    'dbname'   => env('TEST_DB_MYSQL_NAME', 'phalcon_test'),
                    'port'     => env('TEST_DB_MYSQL_PORT', 3306),
                    'charset'  => env('TEST_DB_MYSQL_CHARSET', 'utf8'),
                ]),
            ],
            [
                'adapter' => new Sqlite([
                    'dbname' => env('TEST_DB_SQLITE_NAME', '/tmp/phalcon_test.sqlite'),
                ]),
            ],
            [
                'adapter' => new Postgresql([
                    'host'     => env('TEST_DB_POSTGRESQL_HOST', '127.0.0.1'),
                    'username' => env('TEST_DB_POSTGRESQL_USER', 'postgres'),
                    'password' => env('TEST_DB_POSTGRESQL_PASSWD', ''),
                    'dbname'   => env('TEST_DB_POSTGRESQL_NAME', 'phalcon_test'),
                    'port'     => env('TEST_DB_POSTGRESQL_PORT', 5432),
                ]),
            ],
        ];
    }
}
