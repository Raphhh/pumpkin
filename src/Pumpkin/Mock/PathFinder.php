<?php
namespace Pumpkin\Mock;

use Pumpkin\Test\TestHelper;
use TRex\Parser\ClassName;

/**
 * Class PathFinder
 * @package Pumpkin\Mock
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinder extends TestHelper
{
    /**
     * @return string
     */
    public function findMocksPath()
    {
        $pathFinder = new \Pumpkin\Test\PathFinder($this->getTest());
        return $pathFinder->findPath($this->getFileSubPath(), array('php'));
    }

    /**
     * @return string
     */
    private function getFileSubPath()
    {
        $className = new ClassName($this->getTest()->getReflectedTestMethod()->getDeclaringClass()->getName());
        return sprintf(
            '/resources/mocks/%s/%s', //todo fixtures
            $className->getBaseName(),
            $this->getTest()->getReflectedTestMethod()->getName()
        );
    }
}
