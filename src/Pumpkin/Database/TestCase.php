<?php
namespace Pumpkin\Database;

/**
 * Class TestCase
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
abstract class TestCase extends \PHPUnit_Extensions_Database_TestCase
{
    use TestCaseTrait;
}
