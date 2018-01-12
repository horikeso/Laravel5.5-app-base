<?php

namespace App\Model;

use Illuminate\Support\Facades\Cache;

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
        return $this->createRandom();
    }

    /**
     * sample function
     *
     * @return int
     */
    public function createRandom(): int
    {
        return rand(1, 1000);
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
