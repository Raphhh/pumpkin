<?php
namespace Pumpkin\Mock;

use Pumpkin\Test\Test;
use ReflectionMethod;

/**
 * Class PathFinderTest
 * @package Pumpkin\Mock
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinderTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testFindMocksPathWithFileFounded()
    {
        $realPath = realpath(__DIR__ . '/fixtures/mocks/PathFinderTest');
        $this->assertNotSame(false, $realPath);

        $pathFinder = new PathFinder(new Test(new ReflectionMethod(__CLASS__, __FUNCTION__)));
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
        $pathFinder = new PathFinder(new Test(new ReflectionMethod(__CLASS__, __FUNCTION__)));
        $this->setExpectedException('RuntimeException', 'File not found');
        $pathFinder->findMocksPath();
    }
}
