<?php
namespace Pumpkin\Database\TableConverter;

use Pumpkin\Database\Table;
use Pumpkin\Test\Test;
use ReflectionMethod;

/**
 * Class CsvConverterTest
 * @package Pumpkin\Database\Converter
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class CsvConverterTest extends \PHPUnit_Framework_TestCase
{

    public function testToPhpUnitTable()
    {
        $table = new Table(new Test(new ReflectionMethod(__CLASS__, __FUNCTION__)), 'dbName', 'tableName');

        $converter = new CsvTableConverter($table);
        $this->assertInstanceOf('\PHPUnit_Extensions_Database_DataSet_ITable', $converter->toPhpUnitTable());
    }
}
 