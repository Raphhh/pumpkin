<?php
namespace Pumpkin\resources;

use Pumpkin\TestCase;

class Foo1 extends TestCase
{

    public function getConnection()
    {
        return parent::getConnection();
    }

    public function getTest()
    {
        return parent::getTest();
    }

    public function getName($withDataSet = true)
    {
        if ($withDataSet) {
            return 'currentMethodWithDataSet';
        }
        return 'currentMethod';
    }

    public function currentMethod()
    {

    }
}
