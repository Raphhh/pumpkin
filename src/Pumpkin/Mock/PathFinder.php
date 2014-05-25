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
    public function getTestDirPath()
    {
        return dirname($this->getTest()->getReflectedTestMethod()->getReflector()->getFileName());
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function findMocksPath()
    {
        $level = 0;
        while ($dirPath = realpath($this->resolveDirPathByLevel($level++))) {
            $filePath = $dirPath . $this->getFileSubPath();
            $result = $this->findFilePath($filePath, array('php'));
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
            '/resources/mocks/%s/%s',
            $this->extractClassName($this->getTest()->getReflectedTestMethod()->getClassReflection()->getName()),
            $this->getTest()->getReflectedTestMethod()->getName(false)
        );
    }

    private function extractClassName($fullName)
    {
        $explodedNames = explode('\\', $fullName);
        return array_pop($explodedNames);
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
