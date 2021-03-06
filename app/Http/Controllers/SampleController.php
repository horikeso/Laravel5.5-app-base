<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use Illuminate\Http\Request as HttpRequest;
use Validator;
use Illuminate\View\View;
use App\Models\Sample;

class SampleController extends Controller
{

    /**
     * method GET guerystring and segment validation sample
     *
     * @param string $segment
     * @param string $id
     * @return Response
     */
    public function index(string $segment, string $id)
    {
        $data = [];
        $data['id'] = $id;

        $validator = Validator::make(Request::all(), [
            'query' => 'required'
        ]);
        $validator->after(function($validator) use ($segment) {
            if ($segment !== 'form') {
                $validator->errors()->add('segment', 'segmentが不正です。');
            }
        });

        // use model example
        $sample = Sample::getInstance();
        $data['random'] = $sample->getRandom();

        $data['direct_errors'] = $validator->errors();

        if ($validator->fails()) {
            return view('sample_form', $data);
        }

        return view('sample_form', $data);
    }

    /**
     * method POST validation sample
     *
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function execute(HttpRequest $request)
    {
        $data = [];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|regex:/^(?=.*?[A-Za-z])(?=.*?[0-9])(?=.*?[ -\/:-@\[-`\{-\~])/',
        ],
        [
            'password.regex' => '半角英数記号を含めてください。',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        return view('sample_result', $data);
    }
}
