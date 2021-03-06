<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use App\Models\Database\User;

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
        return random_int(1, 1000);
    }

    /**
     * sample function
     *
     * @param int $id
     * @return \stdClass|null
     */
    public function getUserById(int $id): ?\stdClass
    {
        $user_database_model = User::getInstance();
        return $user_database_model->getById($id);
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
