<?php
namespace Pumpkin\Test;

use Pumpkin\Database\Table;
use Pumpkin\Database\TableBuilder;
use Pumpkin\Mock\MockBuilder;
use ReflectionMethod;

/**
 * Class Test
 * The current test method executed by PHPUnit.
 *
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Test
{
    /**
     * @var ReflectionMethod
     */
    private $reflectedTestMethod;

    /**
     * Constructor.
     *
     * @param ReflectionMethod $reflectedTestMethod
     */
    public function __construct(ReflectionMethod $reflectedTestMethod)
    {
        $this->setReflectedTestMethod($reflectedTestMethod);
    }

    /**
     * The reflected method of current test.
     *
     * @return ReflectionMethod
     */
    public function getReflectedTestMethod()
    {
        return $this->reflectedTestMethod;
    }

    /**
     * Returns the list of mock objects associated with the current test.
     *
     * @param array $constructorArgs
     * @return object[]
     */
    public function getMocks(array $constructorArgs = array())
    {
        $mockBuilder = new MockBuilder($this);
        return $mockBuilder->getMocks($constructorArgs); //todo cache!
    }

    /**
     * Returns the list of database tables associated with the current test.
     *
     * @return Table[]
     */
    public function getTables()
    {
        $tableBuilder = new TableBuilder($this);
        return $tableBuilder->getTables(); //todo cache!
    }



    /**
     * @param ReflectionMethod $reflectedTestMethod
     */
    private function setReflectedTestMethod(ReflectionMethod $reflectedTestMethod)
    {
        $this->reflectedTestMethod = $reflectedTestMethod;
    }
}
