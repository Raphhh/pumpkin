<?php
namespace Pumpkin\Table;

use Pumpkin\Test;

/**
 * Class Table
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Table
{
    /**
     * @var string
     */
    private $dataBaseName;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Test
     */
    private $test;

    /**
     * Constructor.
     *
     * @param Test $test
     * @param string $dataBaseName
     * @param string $tableName
     */
    public function __construct(Test $test, $dataBaseName, $tableName)
    {
        $this->setTest($test);
        $this->setDataBaseName($dataBaseName);
        $this->setName($tableName);
    }

    /**
     * @return Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getDataBaseName() . '.' . $this->getName();
    }

    /**
     * @return string
     */
    public function getDataBaseName()
    {
        return $this->dataBaseName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName($name)
    {
        $this->name = (string)$name;
    }

    /**
     * @param string $dataBaseName
     */
    private function setDataBaseName($dataBaseName)
    {
        $this->dataBaseName = (string)$dataBaseName;
    }

    /**
     * @param Test $test
     */
    private function setTest(Test $test)
    {
        $this->test = $test;
    }
}
