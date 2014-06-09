<?php
namespace Pumpkin\Database;

use Pumpkin\Test\Test;
use TRex\Reflection\MethodReflection;

/**
 * Class TableTest
 * @package Pumpkin\Table
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests the fullname concatenation.
     */
    public function testGetFullName()
    {
        $table = new Table($this->getTestMock(), 'dbName', 'tableName');
        $this->assertSame('dbName.tableName', $table->getFullName());
    }

    /**
     * @return \Pumpkin\Test\Test
     */
    private function getTestMock()
    {
        return $this->getMockBuilder('Pumpkin\Test\Test')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Tests toPhpUnitTable.
     */
    public function testToPhpUnitTable()
    {
        $table = new Table(new Test(new MethodReflection(__CLASS__, __FUNCTION__)), 'dbName', 'tableName');
        $result = $table->toPhpUnitTable();
        $this->assertInstanceOf('PHPUnit_Extensions_Database_DataSet_ITable', $result);
        $this->assertSame('dbName.tableName', $result->getTableMetaData()->getTableName());
    }
}
 