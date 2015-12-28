<?php
namespace Pumpkin\Database;

/**
 * Class TestCaseTrait
 * @package Pumpkin\Database
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
trait TestCaseTrait
{
    use \Pumpkin\Test\TestCaseTrait;

    /**
     * main db connection.
     *
     * @var \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    private static $connection;

    /**
     * @var \PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    private $dataSet;

    /**
     * @param \PDO $connection
     * @param string $schema
     * @return mixed
     */
    abstract protected function createDefaultDBConnection(\PDO $connection, $schema = '');

    /**
     * {@inheritDoc}
     *
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    protected function getConnection()
    {
        if (null === self::$connection) {
            $this->setConnection($this->buildConnection());
        }
        return self::$connection;
    }

    /**
     * Setter of $connection.
     *
     * @param \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection $connection
     */
    private function setConnection(\PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection $connection)
    {
        self::$connection = $connection;
    }

    /**
     * Builder of connection.
     *
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    private function buildConnection()
    {
        return $this->createDefaultDBConnection(
            new \PDO(
                $GLOBALS['db_dsn'],
                $GLOBALS['db_username'],
                $GLOBALS['db_password']
            )
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return \PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        if (null === $this->dataSet) {
            $this->setDataSet($this->buildDataSet());
        }
        return $this->dataSet;
    }

    /**
     * @param \PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet
     */
    private function setDataSet(\PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet)
    {
        $this->dataSet = $dataSet;
    }

    /**
     * @return \PHPUnit_Extensions_Database_DataSet_DefaultDataSet
     */
    private function buildDataSet()
    {
        $result = new \PHPUnit_Extensions_Database_DataSet_DefaultDataSet();
        foreach ($this->getTest()->getTables() as $table) {
            $result->addTable($table->toPhpUnitTable());
        }
        return $result;
    }
}
