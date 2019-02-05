<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Models\Database\User;

class UserController extends Controller
{

    /**
     * 削除
     *
     * @param Illuminate\Http\Request $request
     * @params string $id
     */
    public function delete(HttpRequest $request, string $id)
    {
        $user_database_model = User::getInstance();
        $result_flag = $user_database_model->deleteById((int)$id);

        return redirect()->back();
    }
}
