<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Hobby;
use App\Models\HobbyUser;
use App\Models\Personality;
use App\Models\PersonalityUser;
use App\Models\Job;
use App\Models\JobUser;
use Auth;
use App\Constants\Status;
use Exception;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProfileRequest;
use App\Services\FileNameSetServices;
use Carbon\Carbon;
use App\Services\UserServices;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    const PAGE_COUNT = 4;
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
        $data = $this->service->getList($status);

        return view('users.index', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        // dd($request);
        $authUser = Auth::user();
        $data = $this->service->search($authUser, $request);

        return view('users.index', $data);
    }

    public function show($id)
    {
        $user = User::findorFail($id);
        if(Auth::user()->sex !== $user->sex || Auth::id() === $user->id)
        {
            $age = Carbon::createFromDate($user->birth_date);
            $personalities = Personality::orderBy('id', 'asc')->get();
            $hobbies = Hobby::orderBy('id', 'desc')->get();
            $alljobs = Job::orderBy('id', 'asc')->get();
            $data = [
                "user" => $user,
                "age" => $age,
                "personalities" => $personalities,
                "hobbies" => $hobbies,
                "alljobs" => $alljobs,
            ];
            return view('users.show', $data);
        }
        else
        {
            return redirect('users/show/' . Auth::id());
        }
    }

    public function edit($id)
    {
        $user = User::findorFail($id);

        if(Auth::id() === $user->id)
        {
            $age = Carbon::createFromDate($user->birth_date);

            $hobbies = Hobby::orderBy('id', 'desc')->get();
            $personalities = Personality::orderBy('id', 'asc')->get();
            $alljobs = Job::orderBy('id', 'asc')->get();
            $data = [
                "user" => $user,
                'hobbies' => $hobbies,
                'personalities' => $personalities,
                'alljobs' => $alljobs,
                'age' => $age,
            ];

            return view('users.edit', $data);
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
                $image1->storeAs('public/images/', $imageName1);
                $oldfile1 = $user->img_name1;
                Storage::delete('public/images/'.$oldfile1);
                $user->img_name1 = $imageName1;
            }

            $imageName2 = null;
            // 画像があれば保存
            $image2 = $request['img_name2'];
            if(!is_null($image2)) {
                $imageName2 = FileNameSetServices::fileNameSet($image2);
                $image2->storeAs('public/images/', $imageName2);
                $oldfile2 = $user->img_name2;
                Storage::delete('public/images/'.$oldfile2);
                $user->img_name2 = $imageName2;
            }

            $imageName3 = null;
            // 画像があれば保存
            $image3 = $request['img_name3'];
            if(!is_null($image3)) {
                $imageName3 = FileNameSetServices::fileNameSet($image3);
                $image3->storeAs('public/images/', $imageName3);
                $oldfile3 = $user->img_name3;
                Storage::delete('public/images/'.$oldfile3);
                $user->img_name3 = $imageName3;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->body_height = $request->body_height;
            $user->body_figure = $request->body_figure;
            $user->prefecture = $request->prefecture;
            $user->smoke = $request->smoke;
            $user->alcohol = $request->alcohol;
            $user->income = $request->income;
            $user->education = $request->education;
            $user->housemate = $request->housemate;
            $user->self_introduction = $request->self_introduction;
            $user->save();

            if (is_array($request->hobbies)) {
                $user->updateHobby()->detach(); //ユーザの登録済みのスキルを全て削除
                $user->updateHobby()->attach($request->hobbies); //改めて登録
            }elseif($request->hobbies === null){
                $user->updateHobby()->detach(); //ユーザの登録済みのスキルを全て削除
            }

            if (is_array($request->personalities)) {
                $user->updatePersonality()->detach(); //ユーザの登録済みのスキルを全て削除
                $user->updatePersonality()->attach($request->personalities); //改めて登録
            }elseif($request->personalities === null){
                $user->updatePersonality()->detach(); //ユーザの登録済みのスキルを全て削除
            }

            if ($request->myjob === null) {
                $user->updateJob()->detach(); //ユーザの登録済みのスキルを全て削除
            }else{
                $user->updateJob()->detach(); //ユーザの登録済みのスキルを全て削除
                $user->updateJob()->attach($request->myjob); //改めて登録
            }

            return redirect('users/show/' . Auth::id());
        }
    }
}
