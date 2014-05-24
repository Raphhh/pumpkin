<?php
namespace Pumpkin\Table;

/**
 * Class TableConverterTest
 * @package Pumpkin\Table
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TableConverterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests with a valid file.
     */
    public function testGetPhpUnitTableWithSupportedExtension()
    {
        $tableConverter = new TableConverter();
        $result = $tableConverter->getPhpUnitTable(
            'dbName.tableName',
            __DIR__ . '/resources/databases/dbName/data/tableName.csv'
        );
        $this->assertInstanceOf('PHPUnit_Extensions_Database_DataSet_ITable', $result);
        $this->assertSame('dbName.tableName', $result->getTableMetaData()->getTableName());
    }

    /**
     * test with a extension not supported.
     */
    public function testGetPhpUnitTableWithUnsupportedExtension()
    {
        $tableConverter = new TableConverter();
        $this->setExpectedException('InvalidArgumentException');
        $tableConverter->getPhpUnitTable(
            'dbName.tableName',
            __DIR__ . '/resources/databases/dbName/data/tableName.none'
        );
    }
}
