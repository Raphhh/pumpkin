<?php
namespace Pumpkin;

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
     * @param MethodReflection $reflectedTestMethod
     */
    private function setReflectedTestMethod(MethodReflection $reflectedTestMethod)
    {
        $this->reflectedTestMethod = $reflectedTestMethod;
    }
}
