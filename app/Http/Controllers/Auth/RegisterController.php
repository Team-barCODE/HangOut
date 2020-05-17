<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Services\FileNameSetServices;
use Carbon\Carbon;


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
        $now = Carbon::now();
        $adult = $now->subYears(20);

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'img_name1' => ['required','file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5000'],
            'prefecture' => ['required','string', 'max:255'],
            'sex' => ['required','int'],
            'birth_date' => ['required','date','before_or_equal:'.$adult],
        ],
        [
            'img_name1.required' => '自分の写真は必須です。',
            'prefecture.required' => 'エリアは必須です。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $imageName = null;
        // 画像があれば保存
        $image = $data['img_name1'];
        if(!is_null($image)) {
            $imageName = FileNameSetServices::fileNameSet($image);
            // dd($imageName);
            $image->storeAs('public/images/', $imageName);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'prefecture' => $data['prefecture'],
            'sex' => $data['sex'],
            'img_name1' => $imageName,
            'birth_date' => Carbon::createFromDate($data['birth_date'])->age,
        ]);
    }

    public function redirectPath()
    {
        return 'users/show/' . Auth::id();
    }
}
