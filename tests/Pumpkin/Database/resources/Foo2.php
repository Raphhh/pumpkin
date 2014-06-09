<?php
namespace Pumpkin\Database\resources;

use Pumpkin\Database\TestCase;

class Foo2 extends TestCase
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

    /**
     * @db dbName.tableName2
     * @db dbName.tableName3
     */
    public function currentMethod()
    {

    }

    public function getDataSet()
    {
        return parent::getDataSet();
    }
}
 