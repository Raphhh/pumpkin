<?php
namespace Pumpkin\Mock;

use Pumpkin\Test\Test;
use TRex\Reflection\MethodReflection;

class PathFinderTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testFindMocksPathWithFileFounded()
    {
        $realPath = realpath(__DIR__ . '/resources/mocks/PathFinderTest');
        $this->assertNotSame(false, $realPath);

        $pathFinder = new PathFinder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->assertSame(
            $realPath . DIRECTORY_SEPARATOR . 'testFindMocksPathWithFileFounded.php',
            $pathFinder->findMocksPath()
        );
    }

    /**
     *
     */
    public function testFindMocksPathWithoutFileFounded()
    {
        $pathFinder = new PathFinder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->setExpectedException('RuntimeException');
        $pathFinder->findMocksPath();
    }
}
 