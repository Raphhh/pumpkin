<?php
namespace Pumpkin\Mock;

use Pumpkin\Test;

/**
 * Class PathFinder
 * @package Pumpkin\Mock
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinder
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
     * @return string
     */
    public function findMocksPath()
    {
        $pathFinder = new \Pumpkin\PathFinder($this->getTest());
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

    /**
     * Setter of $test
     *
     * @param Test $test
     */
    private function setTest(Test $test)
    {
        $this->test = $test;
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
}
