<?php
namespace Pumpkin;

use Pumpkin\Database\Annotation as db;

/**
 * Class TestCaseTest
 * @package Pumpkin
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TestCaseTest extends TestCase
{

    /**
     * Tests whether the Reflected Test is the current test.
     */
    public function testGetTest()
    {
        $result = $this->getTest();
        $this->assertSame(
            __FUNCTION__,
            $result->getReflectedTestMethod()->getName()
        );
    }

    public function testGetMocks()
    {
        $this->assertTrue(is_array($this->getMocks()));
        $this->assertArrayHasKey('Foo\Class5', $this->getMocks());
        $this->assertArrayHasKey('Foo\Class6', $this->getMocks());
    }
}
 