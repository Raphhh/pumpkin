<?php
namespace Pumpkin\Table;

use Pumpkin\Test;
use TRex\Reflection\MethodReflection;

/**
 * Class PathFinderTest
 * @package Pumpkin\Table
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests the recovery of the test dir path.
     */
    public function testGetTestDirPath()
    {
        $pathFinder = new PathFinder($this->getTable('tableName'));
        $this->assertSame(__DIR__, $pathFinder->getTestDirPath());
    }

    /**
     * Tests when there is a file.
     */
    public function testFindDataPathWithFileFounded()
    {
        $pathFinder = new PathFinder($this->getTable('tableName'));
        $this->assertSame(
            realpath(__DIR__ . '/resources/databases/dbName/data/tableName.csv'),
            $pathFinder->findDataPath(array('csv'))
        );
    }

    /**
     * Tests when there is no file.
     */
    public function testFindDataPathWithoutFileFounded()
    {
        $pathFinder = new PathFinder($this->getTable('noTableName'));
        $this->setExpectedException('\RuntimeException');
        $pathFinder->findDataPath(array('csv'));
    }

    /**
     * Tests when there is a file, but when the file is situated in the parent resources.
     */
    public function testFindDataPathWithFileFoundedForTheParent()
    {
        $pathFinder = new PathFinder($this->getTable('tableName2'));
        $this->assertSame(
            realpath(__DIR__ . '/../resources/databases/dbName/data/tableName2.csv'),
            $pathFinder->findDataPath(array('csv'))
        );
    }

    /**
     * @param $tableName
     * @return Table
     */
    private function getTable($tableName)
    {
        return new Table($this->getTest(), 'dbName', $tableName);
    }

    /**
     * @return Test
     */
    private function getTest()
    {
        return new Test(new MethodReflection(__CLASS__, __FUNCTION__));
    }
}
 