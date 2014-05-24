<?php
namespace Pumpkin;

use Pumpkin\Table\Table;
use TRex\Reflection\MethodReflection;

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
     * @var MethodReflection
     */
    private $reflectedTestMethod;

    /**
     * Constructor.
     *
     * @param MethodReflection $reflectedTestMethod
     */
    public function __construct(MethodReflection $reflectedTestMethod)
    {
        $this->setReflectedTestMethod($reflectedTestMethod);
    }

    /**
     * The reflected method of current test.
     *
     * @return MethodReflection
     */
    public function getReflectedTestMethod()
    {
        return $this->reflectedTestMethod;
    }

    /**
     * Returns the list of database tables associated with the current test.
     *
     * @return Table[]
     */
    public function getTables()
    {
        $result = array();
        foreach ($this->getReflectedTestMethod()->getAnnotations()->get('db') as $tableFullName) {
            $result[$tableFullName] = $this->getTable($tableFullName);
        }
        return $result;
    }

    /**
     * @param string $tableFullName
     * @return Table
     */
    private function getTable($tableFullName)
    {
        list($dataBaseName, $tableName) = explode('.', $tableFullName);
        return new Table($this, $dataBaseName, $tableName);
    }

    /**
     * @param MethodReflection $reflectedTestMethod
     */
    private function setReflectedTestMethod(MethodReflection $reflectedTestMethod)
    {
        $this->reflectedTestMethod = $reflectedTestMethod;
    }
}
