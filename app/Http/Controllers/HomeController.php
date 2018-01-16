<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Model\Page;
use App\Model\Database\User;
use Request;
use Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $validator = Validator::make(Request::all(), [
            'page' => 'integer'
        ]);

        $page_model = Page::getInstance();
        $user_db_model = User::getInstance();

        $page = $validator->fails() ? 1 : Request::query('page');
        $data['search'] = Cache::get('home_search' . Auth::user()->id);
        $item_count = $user_db_model->getListCount($data['search']);

        $data['page_data'] = $page_model->getPageData($page, $item_count);
        $data['user_object_list'] = $user_db_model->getList($data['page_data']['offset'], $data['page_data']['limit'], $data['search']);

        return view('home', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(HttpRequest $request)
    {
        $data = [];

        $validator = Validator::make(Request::all(), [
            'page' => 'integer'
        ]);

        $page_model = Page::getInstance();
        $user_db_model = User::getInstance();

        $page = $validator->fails() ? 1 : Request::query('page');
        $data['search'] = $request->search;

        if (isset($request->search))
        {
            Cache::put('home_search' . Auth::user()->id, $request->search, config('cache.expire_minutes'));
        }
        else
        {
            Cache::delete('home_search' . Auth::user()->id);
        }

        $item_count = $user_db_model->getListCount($request->search);

        $data['page_data'] = $page_model->getPageData($page, $item_count);
        $data['user_object_list'] = $user_db_model->getList($data['page_data']['offset'], $data['page_data']['limit'], $request->search);

        return view('home', $data);
    }
}
