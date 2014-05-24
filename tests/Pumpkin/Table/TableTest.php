<?php
namespace Pumpkin\Table;

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
     * @return \Pumpkin\Test
     */
    private function getTestMock()
    {
        return $this->getMockBuilder('Pumpkin\Test')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
 