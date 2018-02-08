<?php

namespace Tests\Model;

use Tests\TestCase;
use App\Model\Sample;
use AspectMock\Test as AspectMockTest;

class SampleTest extends TestCase
{
    private static $model;

    public static function setUpBeforeClass()
    {
        self::$model = Sample::getInstance();
    }

    public function testGetRandom()
    {
        AspectMockTest::func('App\Model', 'random_int', 1000);

        $expected = 1000;

        $this->assertSame($expected, self::$model->getRandom());
    }

    public function testGetUserById()
    {
        $object = new \stdClass();

        $test = AspectMockTest::double('App\Model\Database\User', ['getById' => $object]);

        $this->assertSame($object, self::$model->getUserById(1));

        $test->verifyInvokedOnce('getById');
    }

    public function testGetUserByIdNull()
    {
        $test = AspectMockTest::double('App\Model\Database\User', ['getById' => null]);

        $this->assertNull(self::$model->getUserById(1));

        $test->verifyInvokedOnce('getById');
    }

    public function testCache()
    {
        $key = 'test';
        $value1 = 'value1';
        $value2 = 'value2';

        self::$model->setCache($key, $value1);
        $this->assertSame($value1, self::$model->getCache($key));
        self::$model->setCache($key, $value2);
        $this->assertSame($value2, self::$model->getCache($key));
        $this->assertSame($value2, self::$model->getAndDeleteCache($key));
        $this->assertNull(self::$model->getCache($key));
        self::$model->setCache($key, $value1);
        $this->assertSame($value1, self::$model->getCache($key));
        self::$model->deleteCache($key);
        $this->assertNull(self::$model->getCache($key));
    }
}
