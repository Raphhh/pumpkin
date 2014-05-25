<?php
namespace Pumpkin\Mock;

use Pumpkin\TestHelper;
use TRex\Core\Objects;

/**
 * Class MocksBuilder
 * @package Pumpkin\Mock
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class MockBuilder extends TestHelper
{

    /**
     * @param array $constructorArgs
     * @return Objects
     */
    public function getMocks(array $constructorArgs = array())
    {
        $result = new Objects();
        foreach ($this->getClassReflections() as $className => $classReflection) {
            $result[$className] = $classReflection->getReflector()->newInstanceArgs($constructorArgs);
        }
        return $result;
    }

    /**
     * @return \Trex\Reflection\ClassReflection[]
     */
    private function getClassReflections()
    {
        $analyzer = new Trex\Parser\Analyser();
        return $analyzer->getClassReflections($this->getPath());
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
 