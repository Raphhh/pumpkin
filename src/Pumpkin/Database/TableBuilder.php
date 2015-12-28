<?php
namespace Pumpkin\Database;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\Reader;
use Pumpkin\Test\Test;
use Pumpkin\Test\TestHelper;

class TableBuilder extends TestHelper
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * Constructor.
     *
     * @param Test $test
     * @param Reader $reader
     */
    public function __construct(Test $test, Reader $reader = null)
    {
        AnnotationRegistry::registerAutoloadNamespace('Pumpkin\Database\Annotation', __DIR__ . '/../..');
        $this->reader = $reader ?: new AnnotationReader();
        parent::__construct($test);
    }

    /**
     * @return Table[]
     */
    public function getTables()
    {
        $result = array();
        foreach ($this->getAnnotations() as $annotation) {
            if ($annotation instanceof Annotation) {
                $result[$annotation->value] = $this->createTable($annotation->value);
            }
        }
        return $result;
    }

    /**
     * @return array
     */
    private function getAnnotations()
    {
        return $this->reader->getMethodAnnotations($this->getTest()->getReflectedTestMethod());
    }

    /**
     * @param string $tableFullName
     * @return Table
     */
    private function createTable($tableFullName)
    {
        list($dataBaseName, $tableName) = explode('.', $tableFullName);
        return new Table($this->getTest(), $dataBaseName, $tableName);
    }
}
