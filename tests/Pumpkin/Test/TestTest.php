<?php
namespace Pumpkin\Test;

use ReflectionMethod;
use Pumpkin\Database\Annotation as db;

/**
 * Class TestTest
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests getTables.
     *
     * @db("dbName.tableName2")
     * @db("dbName.tableName3")
     */
    public function testGetTables()
    {
        $test = new Test(new ReflectionMethod(__CLASS__, __FUNCTION__));
        $result = $test->getTables();
        $this->assertCount(2, $result);
        $this->assertSame('dbName.tableName2', $result['dbName.tableName2']->getFullName());
        $this->assertSame('dbName.tableName3', $result['dbName.tableName3']->getFullName());
    }

    /**
     * Tests getMocks.
     *
     * @db dbName.tableName2
     * @db dbName.tableName3
     */
    public function testGetMocks()
    {
        $test = new Test(new ReflectionMethod(__CLASS__, __FUNCTION__));
        $result = $test->getMocks();
        $this->assertCount(2, $result);
        $this->assertInstanceOf('Foo\Class1', $result['Foo\Class1']);
        $this->assertInstanceOf('Foo\Class1', $result['Foo\Class1']);
    }
}
 