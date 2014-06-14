<?php
namespace Pumpkin\Database;

/**
 * Interface IConverter
 * @package Pumpkin\Database
 */
interface ITableConverter
{
    /**
     * Constructor;
     *
     * @param Table $table
     */
    public function __construct(Table $table);

    /**
     * Converts Pumpkin\Table in PHPUnit_Extensions_Database_DataSet_ITable.
     *
     * @return \PHPUnit_Extensions_Database_DataSet_ITable
     */
    public function toPhpUnitTable();
}
