<?php
namespace Pumpkin;

/**
 * Class TestCase
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
abstract class TestCase extends \PHPUnit_Extensions_Database_TestCase
{

    /**
     * main db connection.
     *
     * @var \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    private static $connection;

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
}
