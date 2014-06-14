<?php
namespace Pumpkin\Database\TableConverter;


/**
 * Class CsvConverter
 * @package Pumpkin\Database\Converter
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class CsvTableConverter extends TableConverter
{
    /**
     * @return \PHPUnit_Extensions_Database_DataSet_ITable
     */
    public function toPhpUnitTable()
    {
        $dataSet = new \PHPUnit_Extensions_Database_DataSet_CsvDataSet();
        $dataSet->addTable($this->getTable()->getFullName(), $this->getTable()->getDataPath());
        return $dataSet->getTable($this->getTable()->getFullName());
    }
}
