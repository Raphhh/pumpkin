<?php
namespace Pumpkin\Table;

/**
 * Class PathFinder
 * Finds file path for table.
 *
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinder
{

    /**
     * @var Table
     */
    private $table;

    /**
     * Constructor.
     *
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->setTable($table);
    }


    /**
     * @param string[] $supportedExtensions
     * @return string
     * @throws \RuntimeException
     */
    public function findDataPath(array $supportedExtensions)
    {
        $pathFinder = new \Pumpkin\PathFinder($this->getTable()->getTest());
        return $pathFinder->findPath($this->getFileSubPath(), $supportedExtensions);
    }

    /**
     * @return string
     */
    private function getFileSubPath()
    {
        return sprintf(
            '/resources/databases/%s/data/%s',
            $this->getTable()->getDataBaseName(),
            $this->getTable()->getName()
        );
    }

    /**
     * @param Table $table
     */
    private function setTable(Table $table)
    {
        $this->table = $table;
    }

    /**
     * @return Table
     */
    private function getTable()
    {
        return $this->table;
    }
}
