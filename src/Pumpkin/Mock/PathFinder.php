<?php
namespace Pumpkin\Mock;

use Pumpkin\Test\TestHelper;

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
        return sprintf(
            '/resources/mocks/%s/%s',
            $this->extractClassName($this->getTest()->getReflectedTestMethod()->getClassReflection()->getName()),
            $this->getTest()->getReflectedTestMethod()->getName(false)
        );
    }

    /**
     * @param $fullName
     * @return mixed
     */
    private function extractClassName($fullName)
    {
        $explodedNames = explode('\\', $fullName);
        return array_pop($explodedNames);
    }
}
