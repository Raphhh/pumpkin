<?php
namespace Pumpkin\Database\TableConverter;

use Pumpkin\Database\ITableConverter;
use Pumpkin\Database\Table;

/**
 * Class BaseConverter
 * @package Pumpkin\Database\Converter
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
abstract class TableConverter implements ITableConverter
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
     * Getter of $table
     *
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Setter of $table
     *
     * @param Table $table
     */
    private function setTable(Table $table)
    {
        $this->table = $table;
    }
}
