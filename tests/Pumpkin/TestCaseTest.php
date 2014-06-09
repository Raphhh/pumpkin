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
            __METHOD__,
            $result->getReflectedTestMethod()->getName(true)
        );
    }

    public function testGetMocks()
    {
        $this->assertInstanceOf('\TRex\Core\Objects', $this->getMocks());
    }
}
 