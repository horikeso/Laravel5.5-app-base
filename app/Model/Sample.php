<?php

namespace App\Model;

use Illuminate\Support\Facades\Cache;
use App\Model\Database\User;

class Sample
{

    use BaseTrait;

    /**
     * sample function
     *
     * @return int
     */
    public function getRandom(): int
    {
        return rand(1, 1000);
    }

    /**
     * sample function
     *
     * @return boolean
     */
    public function createUser(): bool
    {
        $user_data = [
            'name' => 'test_name',
            'email' => 'test_email',
            'password' => 'test_password',
            'remember_token' => 'test_remember_token',
            'role' => 1,
            'email' => 'test_email',
        ];

        $user_database_model = User::getInstance();
        return $user_database_model->create($user_data);
    }

    /**
     * sample function
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setCache(string $key, $value): void
    {
        Cache::put($key, $value, config('cache.expire_minutes'));
    }

    /**
     * sample function
     *
     * @param string $key
     * @return mixed
     */
    public function getCache(string $key)
    {
        return Cache::get($key);
    }

    /**
     * sample function
     *
     * @param string $key
     * @return mixed
     */
    public function getAndDeleteCache(string $key)
    {
        return Cache::pull($key);
    }

    /**
     * sample function
     *
     * @param string $key
     * @return void
     */
    public function deleteCache(string $key): void
    {
        Cache::forget($key);
    }
}
