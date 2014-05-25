<?php
namespace Pumpkin;

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

}
 