<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hobby;
use App\Models\HobbyUser;
use App\Models\Personality;
use App\Models\PersonalityUser;
use App\Models\Job;
use App\Models\JobUser;
use Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProfileRequest;
use App\Services\FileNameSetServices;
use Carbon\Carbon;
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

        if(Auth::id() === $user->id)
        {
            $age = Carbon::createFromDate($user->birth_date);

            $myhobbies = HobbyUser::with('user')->get();
            $hobbies = Hobby::orderBy('id', 'desc')->get();

            $mypersonalities = PersonalityUser::with('user')->get();
            $personalities = Personality::orderBy('id', 'asc')->get();

            $myjob = JobUser::with('user')->get();
            $alljobs = Job::orderBy('id', 'asc')->get();

            return view('users.edit', compact('user','age','hobbies','myhobbies','personalities','mypersonalities','myjob','alljobs'));
        }
        else
        {
            return redirect('users/edit/' . Auth::id());
        }

    }

    public function update(ProfileRequest $request, $id)
    {
        $user = User::findorFail($id);
        if(Auth::id() === $user->id)
        {

            $imageName1 = null;
            // 画像があれば保存
            $image1 = $request['img_name1'];
            if(!is_null($image1)) {
                $imageName1 = FileNameSetServices::fileNameSet($image1);
                // dd($imageName);
                $image1->storeAs('public/images/', $imageName1);
    
                $user->img_name1 = $imageName1;
            }
    
            $imageName2 = null;
            // 画像があれば保存
            $image2 = $request['img_name2'];
            if(!is_null($image2)) {
                $imageName2 = FileNameSetServices::fileNameSet($image2);
                // dd($imageName);
                $image2->storeAs('public/images/', $imageName2);
    
                $user->img_name2 = $imageName2;
            }
    
            $imageName3 = null;
            // 画像があれば保存
            $image3 = $request['img_name3'];
            if(!is_null($image3)) {
                $imageName3 = FileNameSetServices::fileNameSet($image3);
                // dd($imageName);
                $image3->storeAs('public/images/', $imageName3);
    
                $user->img_name3 = $imageName3;
            }
    
            $user->name = $request->name;
            $user->email = $request->email;
            // $user->sex = $request->sex;
            $user->body_height = $request->body_height;
            $user->body_figure = $request->body_figure;
            $user->smoke = $request->smoke;
            $user->alcohol = $request->alcohol;
            $user->income = $request->income;
            $user->education = $request->education;
            $user->housemate = $request->housemate;
            $user->self_introduction = $request->self_introduction;


    
            $user->save();
            
            if (is_array($request->hobbies)) {
                $user->genreId()->detach(); //ユーザの登録済みのスキルを全て削除
                $user->genreId()->attach($request->hobbies); //改めて登録
            }elseif($request->hobbies === null){
                $user->genreId()->detach(); //ユーザの登録済みのスキルを全て削除
            }
    
            if (is_array($request->personalities)) {
                $user->personalityId()->detach(); //ユーザの登録済みのスキルを全て削除
                $user->personalityId()->attach($request->personalities); //改めて登録
            }elseif($request->personalities === null){
                $user->personalityId()->detach(); //ユーザの登録済みのスキルを全て削除
            }
    
            if ($request->myjob === null) {
                $user->jobId()->detach(); //ユーザの登録済みのスキルを全て削除
            }else{
                $user->jobId()->detach(); //ユーザの登録済みのスキルを全て削除
                $user->jobId()->attach($request->myjob); //改めて登録
            }
    
            return redirect('users/show/' . Auth::id());
        }
    }
}
