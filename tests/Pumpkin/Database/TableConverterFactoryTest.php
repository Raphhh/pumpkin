<?php
namespace Pumpkin\Database;

use Pumpkin\Test\Test;
use TRex\Reflection\MethodReflection;

/**
 * Class TableConverterFactoryTest
 * @package Pumpkin\Database
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TableConverterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSupportedFileExtensions()
    {
        $result = TableConverterFactory::getSupportedFileExtensions();
        $this->assertContains('csv', $result, print_r($result, true) . ' has not "csv" value.');
        $this->assertNotContains('', $result, print_r($result, true) . ' has empty value.');
    }

    public function testBuildWithException()
    {
        $table = new Table(new Test(new MethodReflection(__CLASS__, __FUNCTION__)), 'db', 'table');
        $factory = new TableConverterFactory();

        $this->setExpectedException('\RunTimeException');
        $factory->build($table);
    }

    public function testBuild()
    {
        $table = new Table(new Test(new MethodReflection(__CLASS__, __FUNCTION__)), 'dbName', 'tableName');
        $factory = new TableConverterFactory();

        $this->assertInstanceOf('Pumpkin\Database\ITableConverter', $factory->build($table));
    }
}
 