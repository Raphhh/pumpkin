<?php
namespace Pumpkin;

use TRex\Reflection\MethodReflection;

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
     * @db dbName.tableName2
     * @db dbName.tableName3
     */
    public function testGetTables()
    {
        $test = new Test(new MethodReflection(__CLASS__, __FUNCTION__));
        $result = $test->getTables();
        $this->assertCount(2, $result);
        $this->assertSame('dbName.tableName2', $result['dbName.tableName2']->getFullName());
        $this->assertSame('dbName.tableName3', $result['dbName.tableName3']->getFullName());
    }
}
 