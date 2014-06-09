<?php
namespace Pumpkin;

use Pumpkin\Test\TestCase as TestTrait;

/**
 * Class TestCase
 * provides current mocks for the current test
 *
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    use TestTrait;
}
 