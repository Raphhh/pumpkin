<?php
namespace Pumpkin;

/**
 * Class TestHelper
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
abstract class TestHelper
{
    /**
     * @var Test
     */
    private $test;

    /**
     * Constructor.
     *
     * @param Test $test
     */
    public function __construct(Test $test)
    {
        $this->setTest($test);
    }

    /**
     * Getter of $test
     *
     * @return \Pumpkin\Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Setter of $test
     *
     * @param Test $test
     */
    private function setTest(Test $test)
    {
        $this->test = $test;
    }
}
