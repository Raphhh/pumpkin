<?php
namespace Pumpkin\Test;

use TRex\Reflection\MethodReflection;

/**
 * Class TestCase
 * @package Pumpkin\Test
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
trait TestCase
{
    /**
     * Returns the name of the current test method.
     *
     * @param bool $withDataSet
     * @return string
     */
    abstract function getName($withDataSet = true);

    /**
     * Returns the current test.
     *
     * @return Test
     */
    protected function getTest()
    {
        return new Test(new MethodReflection($this, $this->getName(false)));
    }

    /**
     * Returns the mocks associated with the current test.
     *
     * @param array $constructorArgs
     * @return \TRex\Core\Objects
     */
    protected function getMocks(array $constructorArgs = array())
    {
        return $this->getTest()->getMocks($constructorArgs);
    }
}
 