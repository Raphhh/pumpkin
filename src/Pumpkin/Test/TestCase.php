<?php
namespace Pumpkin\Test;

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
        return new Test(new \ReflectionMethod($this, $this->getName(false)));
    }

    /**
     * Returns the mocks associated with the current test.
     *
     * @param array $constructorArgs
     * @return object[]
     */
    protected function getMocks(array $constructorArgs = array())
    {
        return $this->getTest()->getMocks($constructorArgs);
    }
}
 