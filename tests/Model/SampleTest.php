<?php

namespace Tests\Model;

use Tests\TestCase;

class SampleTest extends TestCase
{
    // @see http://url.com https://github.com/php-mock/php-mock-phpunit
    use \phpmock\phpunit\PHPMock;

    public function testGetRandom()
    {
        $mock = \Mockery::mock('App\Model\Sample');
        $mock->shouldReceive('getRandom')->passthru();// methodをmockせずにそのまま使用する
        $mock->shouldReceive('createRandom')
            ->once()
            ->with()
            ->andReturn(1000);

        $expected = 1000;

        $this->assertSame($expected, $mock->getRandom());
    }

    public function testCreateRandom()
    {
        $mock = \Mockery::mock('App\Model\Sample');
        $mock->shouldReceive('createRandom')->passthru();// methodをmockせずにそのまま使用する

        $rand = $this->getFunctionMock('App\Model', 'rand');// name space App\Model で使用されるrand()をモック
        $rand->expects($this->once())->with(1, 1000)->willReturn(1000);

        $expected = 1000;

        $this->assertSame($expected, $mock->createRandom());
    }
}
