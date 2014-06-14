<?php
namespace Pumpkin\Mock;

use Pumpkin\Test\Test;
use TRex\Reflection\MethodReflection;

/**
 * Class MockBuilderTest
 * @package Pumpkin\Mock
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class MockBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMocks()
    {
        $mockBuilder = new MockBuilder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->assertInstanceOf('TRex\core\Objects', $mockBuilder->getMocks());
    }

    public function testGetMocksWithUndefinedFile()
    {
        $mockBuilder = new MockBuilder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->setExpectedException('RuntimeException', 'File not found');
        $this->assertInstanceOf('TRex\core\Objects', $mockBuilder->getMocks());
    }
}
 