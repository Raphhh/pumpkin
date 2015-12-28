<?php
namespace Pumpkin;

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
    }
}
 