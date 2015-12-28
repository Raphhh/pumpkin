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
     * @var object[]
     */
    private $mocks;

    /**
     * @var Table[]
     */
    private $tables;

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
        if ($this->mocks === null) {
            $mockBuilder = new MockBuilder($this);
            $this->mocks = $mockBuilder->getMocks($constructorArgs);
        }
        return $this->mocks;
    }

    /**
     * Returns the list of database tables associated with the current test.
     *
     * @return Table[]
     */
    public function getTables()
    {
        if ($this->tables === null) {
            $tableBuilder = new TableBuilder($this);
            $this->tables = $tableBuilder->getTables();
        }
        return $this->tables;
    }

    /**
     * @param ReflectionMethod $reflectedTestMethod
     */
    private function setReflectedTestMethod(ReflectionMethod $reflectedTestMethod)
    {
        $this->reflectedTestMethod = $reflectedTestMethod;
    }
}
