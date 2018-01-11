<?php

namespace App\Model;

class Sample extends Base
{

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
}