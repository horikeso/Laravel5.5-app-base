<?php

namespace App\Model\Database;

use Illuminate\Support\Facades\DB;

class User extends Base
{

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