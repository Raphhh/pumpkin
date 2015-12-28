<?php
namespace Pumpkin\Mock;

use Pumpkin\Test\TestHelper;
use TRex\Parser\ClassAnalyzer;

/**
 * Class MocksBuilder
 * @package Pumpkin\Mock
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class MockBuilder extends TestHelper
{

    /**
     * @param array $constructorArgs
     * @return object[]
     */
    public function getMocks(array $constructorArgs = array())
    {
        $result = [];
        foreach ($this->getClassReflections() as $className => $classReflection) {
            $result[$className] = $classReflection->newInstanceArgs($constructorArgs);
        }
        return $result;
    }

    /**
     * @return \ReflectionClass[]
     */
    private function getClassReflections()
    {
        $analyzer = new ClassAnalyzer();
        return $analyzer->getClassReflectionsFromFile($this->getPath());
    }

    /**
     * @return string
     */
    private function getPath()
    {
        $pathfinder = new PathFinder($this->getTest());
        return $pathfinder->findMocksPath();
    }
}
 