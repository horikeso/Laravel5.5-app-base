<?php

namespace App\Model\Database;

// @see https://readouble.com/laravel/5.5/ja/facades.html#how-facades-work
// @see https://laravel.com/api/5.5/Illuminate\Database\Query\Builder.html
use Illuminate\Support\Facades\DB;

class User
{

    use BaseTrait;

    /**
     * IDで取得
     *
     * @param int $id
     * @return \stdClass|null
     */
    public function getById(int $id): ?\stdClass
    {
        $user_object = DB::table($this->table_name)
                ->where('id', $id)
                ->where('delete_flag', 0)
                ->first();

        return $user_object;
    }

    /**
     * ユーザー削除
     *
     * @params int $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        $user_data = [];
        $current_datetime = date('Y-m-d H:i:s');

        $user_data['update_datetime'] = $current_datetime;
        $user_data['delete_datetime'] = $current_datetime;
        $user_data['delete_flag'] = 1;

        try
        {
            $count = DB::table($this->table_name)
                ->where('id', $id)
                ->update($user_data);
        }
        catch(\Exception $exception)
        {
        	\Log::error($exception->getMessage());
            return false;
        }

        return $count === 1;
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
            $builder->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
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
            $builder->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if (isset($offset) && isset($limit))
        {
            $builder->offset($offset)->limit($limit);
        }

        $user_object_list = $builder->get()->all();

        return $user_object_list;
    }
}
