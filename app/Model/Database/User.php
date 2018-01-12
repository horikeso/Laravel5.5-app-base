<?php

namespace App\Model\Database;

// @see https://readouble.com/laravel/5.5/ja/facades.html#how-facades-work
// @see https://laravel.com/api/5.5/Illuminate\Database\Query\Builder.html
use Illuminate\Support\Facades\DB;

class User
{

    use BaseTrait;

    /**
     * ユーザー登録
     *
     * @param array $user_data
     * @return boolean
     */
    public function create(array $user_data): bool
    {
        try
        {
            $result_flag = DB::table($this->table_name)
                ->insert($user_data);
        }
        catch(\Exception $exception)
        {
        	\Log::error($exception->getMessage());
            return false;
        }

        return $result_flag;
    }
}
