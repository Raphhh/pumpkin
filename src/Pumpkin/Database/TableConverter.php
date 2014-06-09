<?php
namespace Pumpkin\Database;

/**
 * Class TableConverter
 * Converts Pumpkin\Table in PHPUnit_Extensions_Database_DataSet_ITable.
 *
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TableConverter
{

    /**
     * @return string[]
     */
    public static function getSupportedFileExtensions()
    {
        return array(
            'csv',
        );
    }

    /**
     * Converts Pumpkin\Table in PHPUnit_Extensions_Database_DataSet_ITable.
     *
     * @param string $tableFullName
     * @param string $path
     * @throws \InvalidArgumentException
     * @return \PHPUnit_Extensions_Database_DataSet_ITable
     */
    public function getPhpUnitTable($tableFullName, $path)
    {
        switch (pathinfo($path, PATHINFO_EXTENSION)) {
            case 'csv':
                return $this->getDataSetCsv($tableFullName, $path);
        }
        throw new \InvalidArgumentException(sprintf('Not a supported file extension for "%s"', $path));
    }

    /**
     * @param string $tableName
     * @param string $path
     * @return \PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    private function getDataSetCsv($tableName, $path)
    {
        $dataSet = new \PHPUnit_Extensions_Database_DataSet_CsvDataSet();
        $dataSet->addTable($tableName, $path);
        return $dataSet->getTable($tableName);
    }
}
