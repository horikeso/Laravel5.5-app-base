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

    /**
     * ユーザー数を取得
     *
     * @param string|null $search
     * @return int
     */
    public function getListCount(string $search = null): int
    {
        $builder = DB::table($this->table_name)
                ->where('delete_flag', 0);

        if ( ! empty($search))
        {
            $builder->where('name', 'like', '%' . $search . '%');
        }

        $user_count = $builder->count();

        return $user_count;
    }

    /**
     * ユーザー一覧を取得
     *
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $search
     * @return array[\stdClass]
     */
    public function getList(int $offset = null, int $limit = null, string $search = null): array
    {
        $builder = DB::table($this->table_name)
                ->where('delete_flag', 0)
                ->orderBy('id', 'desc');

        if ( ! empty($search))
        {
            $builder->where('name', 'like', '%' . $search . '%');
        }

        if (isset($offset) && isset($limit))
        {
            $builder->offset($offset)->limit($limit);
        }

        $user_object_list = $builder->get()->all();

        return $user_object_list;
    }
}
