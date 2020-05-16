<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProfileRequest;
use App\Services\FileNameSetServices;
use App\Services\UserServices;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $repository;
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServices $service,UserRepository $repository)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(int $status = 0)
    {
        // dd($this->service->getNum());
        $users = $this->service->getList($status);

        // 表示テスト用
        $authUser = Auth::user();
        $userCount = $users->count();
        $from_user_id = $authUser->id;
        $data = [
            "me" => $authUser,
            "users" => $users,
            "userCount" => $userCount,
            "from_user_id" => $from_user_id,
        ];
        // dd($users);
        return view('users.index', $data);
    }

    public function show($id)
    {
        $user = User::findorFail($id);
        $data = [
            "user" => $user,
        ];
        return view('users.show', $data);
    }

    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(ProfileRequest $request, $id)
    {

        $user = User::findorFail($id);

        $imageName = null;
        // 画像があれば保存
        $image = $request['img_name1'];
        if(!is_null($image)) {
            $imageName = FileNameSetServices::fileNameSet($image);
            // dd($imageName);
            $image->storeAs('public/images/', $imageName);

            $user->img_name1 = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->self_introduction = $request->self_introduction;

        $user->save();

        return redirect('users/show/' . Auth::id());
    }
}
