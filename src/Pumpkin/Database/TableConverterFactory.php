<?php
namespace Pumpkin\Database;

/**
 * Class ConverterFactory
 * @package Pumpkin\Database
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TableConverterFactory
{

    /**
     * @var string[]
     */
    private static $supportedFileExtensions;

    /**
     * @return string[]
     */
    public static function getSupportedFileExtensions()
    {
        if (null === self::$supportedFileExtensions) {
            foreach (scandir(__DIR__ . DIRECTORY_SEPARATOR . 'TableConverter') as $fileName) {
                $extension = substr($fileName, 0, -strlen('TableConverter.php'));
                if ($extension) {
                    self::$supportedFileExtensions[] = strtolower($extension);
                }
            }
        }
        return self::$supportedFileExtensions;
    }

    /**
     * @param Table $table
     * @return ITableConverter
     */
    public function build(Table $table)
    {
        $className = $this->getClassName($table->getDataPath());
        return new $className($table);
    }

    /**
     * @param string $path
     * @return string
     * @throws \RuntimeException
     */
    private function getClassName($path)
    {
        $className = 'Pumpkin\Database\TableConverter\\' . pathinfo($path, PATHINFO_EXTENSION) . 'TableConverter';
        if (class_exists($className)) {
            return $className;
        }
        throw new \RuntimeException(
            sprintf('This file extension is not supported: "%s"', pathinfo($path, PATHINFO_EXTENSION))
        );
    }
}
