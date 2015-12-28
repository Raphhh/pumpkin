<?php
namespace Pumpkin\Database;

use Pumpkin\Test\Test;

/**
 * Class PathFinderTest
 * @package Pumpkin\Table
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests when there is a file.
     */
    public function testFindDataPathWithFileFounded()
    {
        $realPath = realpath(__DIR__ . '/resources/databases/dbName/data/tableName.csv');
        $this->assertNotSame(false, $realPath);

        $pathFinder = new PathFinder($this->getTable('tableName'));
        $this->assertSame($realPath, $pathFinder->findDataPath(array('csv')));
    }

    /**
     * Tests when there is no file.
     */
    public function testFindDataPathWithoutFileFounded()
    {
        $pathFinder = new PathFinder($this->getTable('noTableName'));
        $this->setExpectedException('\RuntimeException', 'File not found');
        $pathFinder->findDataPath(array('csv'));
    }

    /**
     * Tests when there is a file, but when the file is situated in the parent resources.
     */
    public function testFindDataPathWithFileFoundedForTheParent()
    {
        $realPath = realpath(__DIR__ . '/../resources/databases/dbName/data/tableName2.csv');
        $this->assertNotSame(false, $realPath);

        $pathFinder = new PathFinder($this->getTable('tableName2'));
        $this->assertSame($realPath, $pathFinder->findDataPath(array('csv')));
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
        return new Test(new \ReflectionMethod(__CLASS__, __FUNCTION__));
    }
}
 