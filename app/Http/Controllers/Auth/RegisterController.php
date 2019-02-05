<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Database\User as DatabaseUser;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web', ['except' => [
            'showGeneralRegistrationForm',
            'generalRegister',
        ]]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Za-z])(?=.*?[0-9])(?=.*?[ -\/:-@\[-`\{-\~])/',
        ],
        [
            'password.regex' => '半角英数記号を含めてください。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => \App\Models\Role::ADMIN,
        ]);
    }

    // RegistersUsers traitの上書き

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // 管理者が登録されているか
        $userDatabaseModel = DatabaseUser::getInstance();
        if ($userDatabaseModel->isRegisteredAdmin())
        {
            return redirect()->route('login');
        }

        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // 管理者が登録されているか
        $userDatabaseModel = DatabaseUser::getInstance();
        if ($userDatabaseModel->isRegisteredAdmin())
        {
            return redirect()->back()->withErrors(['admin' => 'これ以上の登録はできません。'])->withInput();
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    // 追加

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGeneralRegistrationForm()
    {
        return view('general.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generalRegister(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->generalCreate($request->all())));

        return redirect()->route('general');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    private function generalCreate(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => \App\Models\Role::GENERAL,
        ]);
    }
}
