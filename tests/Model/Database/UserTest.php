<?php

namespace Tests\Model\Database;

use Tests\TestCase;
use App\Model\Database\User;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    private static $user;

    public static function setUpBeforeClass()
    {
        self::$user = User::getInstance();
    }

    protected function tearDown()
    {
        DB::table(self::$user->getTableName())->truncate();

        parent::tearDown();
    }

    public function testCreateSuccess()
    {
        $user_data = [
            'name' => 'test_name',
            'email' => 'test_email',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'email' => 'test_email',
        ];

        $this->assertTrue(self::$user->create($user_data));
    }

    public function testCreateFailure()
    {
        $user_data = [
            'name' => 'test_name',
            'email' => 'test_email',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'email' => 'test_email',
        ];

        $this->assertTrue(self::$user->create($user_data));
        $this->assertFalse(self::$user->create($user_data));
    }
}
