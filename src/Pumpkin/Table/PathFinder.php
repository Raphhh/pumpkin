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
     * @return string
     */
    public function getTestDirPath()
    {
        return dirname($this->getTable()->getTest()->getReflectedTestMethod()->getReflector()->getFileName());
    }

    /**
     * @param string[] $supportedExtensions
     * @return string
     * @throws \RuntimeException
     */
    public function findDataPath(array $supportedExtensions)
    {
        $level = 0;
        while ($dirPath = realpath($this->resolveDirPathByLevel($level++))) {
            $filePath = $dirPath . $this->getFileSubPath();
            $result = $this->findFilePath($filePath, $supportedExtensions);
            if ($result) {
                return $result;
            }
        }
        throw new \RuntimeException(
            sprintf('Not file found in "%s"', $this->resolveDirPathByLevel(0) . $this->getFileSubPath() . '.*')
        );
    }

    /**
     * @param $level
     * @return string
     */
    private function resolveDirPathByLevel($level)
    {
        return $this->getTestDirPath()
        . DIRECTORY_SEPARATOR
        . implode(DIRECTORY_SEPARATOR, $this->getLevelPaths($level));
    }

    /**
     * @param $level
     * @return array
     */
    private function getLevelPaths($level)
    {
        if ($level) {
            return array_fill(0, $level, '..');
        }
        return array();
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

    private function findFilePath($filePath, array $supportedExtensions)
    {
        foreach ($supportedExtensions as $ext) {
            $path = realpath($filePath . '.' . $ext);
            if ($path && is_readable($path)) {
                return $path;
            }
        }
        return '';
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
