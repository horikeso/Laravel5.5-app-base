<?php

namespace Tests\Model\Database;

use Tests\TestCase;
use App\Model\Database\User;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    private static $model;

    public static function setUpBeforeClass()
    {
        self::$model = User::getInstance();
    }

    protected function tearDown()
    {
        DB::table(self::$model->getTableName())->truncate();

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

        $this->assertTrue(self::$model->create($user_data));
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

        $this->assertTrue(self::$model->create($user_data));
        $this->assertFalse(self::$model->create($user_data));
    }

    public function testGetListCount()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_datetime' => '2018-01-01 00:00:00',
            'delete_flag' => 1,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $expected = 2;

        $this->assertSame($expected, self::$model->getListCount());
    }

    public function testGetListCountSearch()
    {
        $user_data1 = [
            'name' => 'target_test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_datetime' => '2018-01-01 00:00:00',
            'delete_flag' => 1,
        ];

        $user_data2 = [
            'name' => 'target_test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $expected = 1;
        $search = 'target';
        $this->assertSame($expected, self::$model->getListCount($search));
    }

    public function testGetList()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);

        $object1 = new \stdClass();
        $object1->id = 1;
        $object1->name = $user_data1['name'];
        $object1->email = $user_data1['email'];
        $object1->password = $user_data1['password'];
        $object1->remember_token = $user_data1['remember_token'];
        $object1->role = $user_data1['role'];
        $object1->updated_at = $user_data1['updated_at'];
        $object1->created_at = $user_data1['created_at'];
        $object1->delete_datetime = null;
        $object1->delete_flag = $user_data1['delete_flag'];

        $object2 = new \stdClass();
        $object2->id = 2;
        $object2->name = $user_data2['name'];
        $object2->email = $user_data2['email'];
        $object2->password = $user_data2['password'];
        $object2->remember_token = $user_data2['remember_token'];
        $object2->role = $user_data2['role'];
        $object2->updated_at = $user_data2['updated_at'];
        $object2->created_at = $user_data2['created_at'];
        $object2->delete_datetime = null;
        $object2->delete_flag = $user_data2['delete_flag'];

        $expected = [$object2, $object1];

        $this->assertEquals($expected, self::$model->getList());
    }

    public function testGetListEmpty()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_datetime' => '2018-01-01 00:00:00',
            'delete_flag' => 1,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_datetime' => '2018-01-01 00:00:00',
            'delete_flag' => 1,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);

        $this->assertSame([], self::$model->getList());
    }

    public function testGetListOffsetLimit01()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $object3 = new \stdClass();
        $object3->id = 3;
        $object3->name = $user_data3['name'];
        $object3->email = $user_data3['email'];
        $object3->password = $user_data3['password'];
        $object3->remember_token = $user_data3['remember_token'];
        $object3->role = $user_data3['role'];
        $object3->updated_at = $user_data3['updated_at'];
        $object3->created_at = $user_data3['created_at'];
        $object3->delete_datetime = null;
        $object3->delete_flag = $user_data3['delete_flag'];

        $expected = [$object3];

        $offset = 0;
        $limit = 1;
        $this->assertEquals($expected, self::$model->getList($offset, $limit));
    }

    public function testGetListOffsetLimit12()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $object1 = new \stdClass();
        $object1->id = 1;
        $object1->name = $user_data1['name'];
        $object1->email = $user_data1['email'];
        $object1->password = $user_data1['password'];
        $object1->remember_token = $user_data1['remember_token'];
        $object1->role = $user_data1['role'];
        $object1->updated_at = $user_data1['updated_at'];
        $object1->created_at = $user_data1['created_at'];
        $object1->delete_datetime = null;
        $object1->delete_flag = $user_data1['delete_flag'];

        $object2 = new \stdClass();
        $object2->id = 2;
        $object2->name = $user_data2['name'];
        $object2->email = $user_data2['email'];
        $object2->password = $user_data2['password'];
        $object2->remember_token = $user_data2['remember_token'];
        $object2->role = $user_data2['role'];
        $object2->updated_at = $user_data2['updated_at'];
        $object2->created_at = $user_data2['created_at'];
        $object2->delete_datetime = null;
        $object2->delete_flag = $user_data2['delete_flag'];

        $expected = [$object2, $object1];

        $offset = 1;
        $limit = 2;
        $this->assertEquals($expected, self::$model->getList($offset, $limit));
    }

    public function testGetListOffsetLimit10()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $expected = [];

        $offset = 1;
        $limit = 0;
        $this->assertSame($expected, self::$model->getList($offset, $limit));
    }

    public function testGetListOffsetLimit1null()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $object1 = new \stdClass();
        $object1->id = 1;
        $object1->name = $user_data1['name'];
        $object1->email = $user_data1['email'];
        $object1->password = $user_data1['password'];
        $object1->remember_token = $user_data1['remember_token'];
        $object1->role = $user_data1['role'];
        $object1->updated_at = $user_data1['updated_at'];
        $object1->created_at = $user_data1['created_at'];
        $object1->delete_datetime = null;
        $object1->delete_flag = $user_data1['delete_flag'];

        $object2 = new \stdClass();
        $object2->id = 2;
        $object2->name = $user_data2['name'];
        $object2->email = $user_data2['email'];
        $object2->password = $user_data2['password'];
        $object2->remember_token = $user_data2['remember_token'];
        $object2->role = $user_data2['role'];
        $object2->updated_at = $user_data2['updated_at'];
        $object2->created_at = $user_data2['created_at'];
        $object2->delete_datetime = null;
        $object2->delete_flag = $user_data2['delete_flag'];

        $object3 = new \stdClass();
        $object3->id = 3;
        $object3->name = $user_data3['name'];
        $object3->email = $user_data3['email'];
        $object3->password = $user_data3['password'];
        $object3->remember_token = $user_data3['remember_token'];
        $object3->role = $user_data3['role'];
        $object3->updated_at = $user_data3['updated_at'];
        $object3->created_at = $user_data3['created_at'];
        $object3->delete_datetime = null;
        $object3->delete_flag = $user_data3['delete_flag'];

        $expected = [$object3, $object2, $object1];

        $offset = 1;
        $this->assertEquals($expected, self::$model->getList($offset));
    }

    public function testGetListOffsetLimitnull1()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $object1 = new \stdClass();
        $object1->id = 1;
        $object1->name = $user_data1['name'];
        $object1->email = $user_data1['email'];
        $object1->password = $user_data1['password'];
        $object1->remember_token = $user_data1['remember_token'];
        $object1->role = $user_data1['role'];
        $object1->updated_at = $user_data1['updated_at'];
        $object1->created_at = $user_data1['created_at'];
        $object1->delete_datetime = null;
        $object1->delete_flag = $user_data1['delete_flag'];

        $object2 = new \stdClass();
        $object2->id = 2;
        $object2->name = $user_data2['name'];
        $object2->email = $user_data2['email'];
        $object2->password = $user_data2['password'];
        $object2->remember_token = $user_data2['remember_token'];
        $object2->role = $user_data2['role'];
        $object2->updated_at = $user_data2['updated_at'];
        $object2->created_at = $user_data2['created_at'];
        $object2->delete_datetime = null;
        $object2->delete_flag = $user_data2['delete_flag'];

        $object3 = new \stdClass();
        $object3->id = 3;
        $object3->name = $user_data3['name'];
        $object3->email = $user_data3['email'];
        $object3->password = $user_data3['password'];
        $object3->remember_token = $user_data3['remember_token'];
        $object3->role = $user_data3['role'];
        $object3->updated_at = $user_data3['updated_at'];
        $object3->created_at = $user_data3['created_at'];
        $object3->delete_datetime = null;
        $object3->delete_flag = $user_data3['delete_flag'];

        $expected = [$object3, $object2, $object1];

        $limit = 1;
        $this->assertEquals($expected, self::$model->getList(null, $limit));
    }

    public function testGetListOffsetLimitSearch15test_name()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $object1 = new \stdClass();
        $object1->id = 1;
        $object1->name = $user_data1['name'];
        $object1->email = $user_data1['email'];
        $object1->password = $user_data1['password'];
        $object1->remember_token = $user_data1['remember_token'];
        $object1->role = $user_data1['role'];
        $object1->updated_at = $user_data1['updated_at'];
        $object1->created_at = $user_data1['created_at'];
        $object1->delete_datetime = null;
        $object1->delete_flag = $user_data1['delete_flag'];

        $object2 = new \stdClass();
        $object2->id = 2;
        $object2->name = $user_data2['name'];
        $object2->email = $user_data2['email'];
        $object2->password = $user_data2['password'];
        $object2->remember_token = $user_data2['remember_token'];
        $object2->role = $user_data2['role'];
        $object2->updated_at = $user_data2['updated_at'];
        $object2->created_at = $user_data2['created_at'];
        $object2->delete_datetime = null;
        $object2->delete_flag = $user_data2['delete_flag'];

        $expected = [$object2, $object1];

        $offset = 1;
        $limit = 5;
        $search = 'test_name';
        $this->assertEquals($expected, self::$model->getList($offset, $limit, $search));
    }

    public function testGetListSearch2()
    {
        $user_data1 = [
            'name' => 'test_name',
            'email' => 'test_email1',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data2 = [
            'name' => 'test_name2',
            'email' => 'test_email2',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        $user_data3 = [
            'name' => 'test_name',
            'email' => 'test_email3',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 2,
            'updated_at' => '2018-01-01 00:00:00',
            'created_at' => '2018-01-01 00:00:00',
            'delete_flag' => 0,
        ];

        DB::table(self::$model->getTableName())->insert($user_data1);
        DB::table(self::$model->getTableName())->insert($user_data2);
        DB::table(self::$model->getTableName())->insert($user_data3);

        $object2 = new \stdClass();
        $object2->id = 2;
        $object2->name = $user_data2['name'];
        $object2->email = $user_data2['email'];
        $object2->password = $user_data2['password'];
        $object2->remember_token = $user_data2['remember_token'];
        $object2->role = $user_data2['role'];
        $object2->updated_at = $user_data2['updated_at'];
        $object2->created_at = $user_data2['created_at'];
        $object2->delete_datetime = null;
        $object2->delete_flag = $user_data2['delete_flag'];

        $expected = [$object2];

        $search = '2';
        $this->assertEquals($expected, self::$model->getList(null, null, $search));
    }
}
