<?php
namespace Pumpkin\Test;

/**
 * Class PathFinder
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PathFinder extends TestHelper
{

    /**
     * @return string
     */
    public function getTestDirPath()
    {
        return dirname($this->getTest()->getReflectedTestMethod()->getFileName());
    }

    /**
     * @param string $filePatternPath
     * @param string[] $supportedExtensions
     * @throws \RuntimeException
     * @return string
     */
    public function findPath($filePatternPath, array $supportedExtensions)
    {
        $filePatternPath = DIRECTORY_SEPARATOR . $filePatternPath;
        $level = 0;
        while ($dirPath = realpath($this->resolveDirPathByLevel($level++))) {
            $result = $this->findFilePath($dirPath . $filePatternPath, $supportedExtensions);
            if ($result) {
                return $result;
            }
        }
        throw new \RuntimeException(
            sprintf('File not found for "%s"', $this->resolveDirPathByLevel(0) . $filePatternPath . '.*')
        );
    }

    /**
     * @param int $level
     * @return string
     */
    private function resolveDirPathByLevel($level)
    {
        return $this->getTestDirPath()
        . DIRECTORY_SEPARATOR
        . implode(DIRECTORY_SEPARATOR, $this->getLevelPaths($level));
    }

    /**
     * @param int $level
     * @return string[]
     */
    private function getLevelPaths($level)
    {
        if ($level) {
            return array_fill(0, $level, '..');
        }
        return array();
    }

    /**
     * @param string $filePath
     * @param string[] $supportedExtensions
     * @return string
     */
    private function findFilePath($filePath, array $supportedExtensions)
    {
        foreach ($supportedExtensions as $ext) {
            $path = realpath($filePath . '.' . ltrim($ext, '.'));
            if ($path && is_readable($path)) {
                return $path;
            }
        }
        return '';
    }
}
 