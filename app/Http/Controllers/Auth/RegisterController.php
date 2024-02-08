<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'between:4,12'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'between:8,128'],
                'password_confirmation' => [
                    'required', 'same:password'
                ],
            ],
            [
                'name.required' => 'ユーザー名を入力してください。',
                'name.between' => 'ユーザー名は4文字以上12文字以内で入力してください',
                'email.required' => 'メールアドレスを入力してください。',
                'email.email' => 'メールアドレスは正しい形式で入力してください。',
                'email.max' => 'メールアドレスは255文字以内で入力してください。',
                'email.unique' => '入力されたメールアドレスはすでに登録されています。別のメールアドレスを登録してください。',
                'password.required' => 'パスワードを入力してください。',
                'password.between' => 'パスワードは8文字以上128文字以内で入力してください。',
                'password_confirmation.same' => 'パスワードと確認用パスワードが一致していません',
                'password_confirmation.required' => 'パスワード確認を入力してください。',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
