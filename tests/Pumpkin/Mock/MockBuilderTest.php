<?php
namespace Pumpkin\Mock;

use Pumpkin\Test\Test;
use ReflectionMethod;

/**
 * Class MockBuilderTest
 * @package Pumpkin\Mock
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class MockBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMocks()
    {
        $mockBuilder = new MockBuilder(new Test(new ReflectionMethod(__CLASS__, __FUNCTION__)));
        $mocks = $mockBuilder->getMocks();
        $this->assertTrue(is_array($mocks));
        $this->assertCount(2, $mocks);
        $this->assertArrayHasKey('Foo\Class3', $mocks);
        $this->assertArrayHasKey('Foo\Class4', $mocks);
    }

    public function testGetMocksWithUndefinedFile()
    {
        $mockBuilder = new MockBuilder(new Test(new ReflectionMethod(__CLASS__, __FUNCTION__)));
        $this->setExpectedException('RuntimeException', 'File not found');
        $this->assertInstanceOf('TRex\core\Objects', $mockBuilder->getMocks());
    }
}
 