# README

[![Build Status](https://travis-ci.org/Raphhh/pumpkin.png)](https://travis-ci.org/Raphhh/pumpkin)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Raphhh/pumpkin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/pumpkin/)
[![Code Coverage](https://scrutinizer-ci.com/g/Raphhh/pumpkin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/pumpkin/)

## What is Pumpkin?

Pumpkin helps you to organize the storage of your mocks for PHPUnit. It gives mocks objects and database resources when you execute a test.


## How to start?

You just have to add the Pumpkin package in your composer.json and update your project.

```
$ php composer.phar require raphhh/pumpkin
```

## What can I do?

### Get the current test

Usually, when you use PHPUnit, you create a new test class extending \PHPUnit_Framework_TestCase. Instead, with Pumkin, you have to extend \Pumpkin\TestCase.

\Pumpkin\TestCase extends \PHPUnit_Framework_TestCase, so you have the same interface as if you use PHPUnit.

But you can also know the current test with \Pumpkin\TestCase::getTest(). You receive a \Pumpkin\Test\Test object which reflects the current method of the test.

The current test is the method executed by PHPUnit and containing your assertions. Typically, this is a test* method.

For example

```php
class FooTest extends Pumpkin\TestCase{

    function testA(){
        $this->getTest()->getReflectedTestMethod()->getName(); //FooTest::testA
    }

    function testB(){
        $this->getTest()->getReflectedTestMethod()->getName(); //FooTest::testB
    }
}
```

With this method you can reflected the method of the executed test, retrieve annotations, ... anything!


### Get mocks of the current test

You can retrieve mocks of a the current test. Mocks objects must be user objects. They are declared in a specific file for the current test.

The file is located in the following path:
```
/resources/mocks/{ClassTestName}/{methodName}.php
```

This path can start from the test directory or from a parent one.

You can declare as many mocks as you want in this file.



For example

```php
// Test case

class FooTest extends Pumpkin\TestCase{

    function testA(){
        $this->getMocks(); //returns [Mock1, Mock2]
    }

}
```

```php
// /resources/mocks/FooTest/testA.php

class Mock1{}

class mock2{}
```


### Reset the database with specific data for the current test

When you want to mock databases with PHPUnit, you need to use \PHPUnit_Extensions_Database_TestCase. Instead, with Pumkin, you have to extend \Pumpkin\Database\TestCase.

\Pumpkin\Database\TestCase extends \PHPUnit_Extensions_Database_TestCase, so you have the same interface as if you use PHPUnit.

#### The annotations

But you can also specify the tables you want to load for the current test. This is done in the comments of the current test, with the @db tag.

```php
// Test case

class FooTest extends Pumpkin\database\TestCase{

    /**
     * @db my_database.my_table
     * @db my_other_database.my_other_table
     */
    function testA(){
       //my_database.my_table and my_other_database.my_other_table data will be load when this test will be executed
    }

}
```

#### The data file

The data are stored in a file with the following path:
```
/resources/databases/{databaseName}/data/{tableName}.csv
```

Currently, Pumpkin support only csv files, but it can be evolved in future.

Your data can be specific for the current test, or be common with several tests. Everything is determined by the data file path. If you want specific data, you have to locate the data file in the directory of your test. If you want common data, you have to locate the data file in a common directory of your tests.


#### The database config

If you want to load your mocked data, you have to allow PHPUnit to access to your database. With Pumkin you have just to specify your config in the phpunit.xml.

For example

```xml
<phpunit>

    <php>
        <var name="db_dsn" value="mysql:dbname=my_db;host=127.0.0.1"/>
        <var name="db_username" value="root"/>
        <var name="db_password" value=""/>
    </php>

    ... other phpunit config

</phpunit>
```