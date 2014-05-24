<?php
namespace Pumpkin;

use Pumpkin\resources\Foo1;
use Pumpkin\resources\Foo2;

/**
 * Class TestCaseTest
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TestCaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests whether the connection is a single instance.
     */
    public function testGetConnection()
    {

        $foo1 = new Foo1();
        $connection1 = $foo1->getConnection();

        $this->assertInstanceOf('\PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection', $connection1);
        $this->assertSame($connection1, $foo1->getConnection());

        $foo2 = new Foo2();
        $this->assertSame($connection1, $foo2->getConnection());
    }

    /**
     * Tests whether the Reflected Test is the current test.
     */
    public function testGetTest()
    {
        $foo = new Foo1();
        $result = $foo->getTest();
        $this->assertSame(
            'Pumpkin\resources\Foo1::currentMethod',
            $result->getReflectedTestMethod()->getName(true)
        );
    }

    /**
     * Tests the result of getDataSet
     */
    public function testGetDataSet()
    {
        $foo = new Foo1();
        $this->assertInstanceOf('PHPUnit_Extensions_Database_DataSet_IDataSet', $foo->getDataSet());
        $this->assertSame(array('dbName.tableName2', 'dbName.tableName3'), $foo->getDataSet()->getTableNames());
    }

    /**
     * Tests the cache of getDataSet
     */
    public function testGetDataSetCache()
    {
        $foo1 = new Foo1();
        $result1 = $foo1->getDataSet();
        $this->assertSame($result1, $foo1->getDataSet());

        $foo2 = new Foo2();
        $this->assertNotSame($result1, $foo2->getDataSet());
    }
}
