<?php
namespace Pumpkin\Test;

use TRex\Reflection\MethodReflection;

/**
 * Class PathFinderTest
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the recovery of the test dir path.
     */
    public function testGetTestDirPath()
    {
        $pathFinder = new PathFinder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->assertSame(__DIR__, $pathFinder->getTestDirPath());
    }

    public function testFindPathWithException()
    {
        $pathFinder = new PathFinder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->setExpectedException('RuntimeException', 'File not found');
        $pathFinder->findPath('IAmNotAFile', array('.php'));
    }

    public function testFindPathWithSlash()
    {
        $pathFinder = new PathFinder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->assertSame(__FILE__, $pathFinder->findPath('/PathFinderTest', array('php')));
    }

    public function testFindPathWithoutSlash()
    {
        $pathFinder = new PathFinder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->assertSame(__FILE__, $pathFinder->findPath('PathFinderTest', array('php')));
    }

    public function testFindPathWithDotInTheExt()
    {
        $pathFinder = new PathFinder(new Test(new MethodReflection(__CLASS__, __FUNCTION__)));
        $this->assertSame(__FILE__, $pathFinder->findPath('PathFinderTest', array('.php')));
    }

}
 