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
        $users = $this->service->getList($status);

        // 表示テスト用
        $authUser = Auth::user();
        $userCount = $users->count();
        $from_user_id = $authUser->id;
        $hobbies2 = Hobby::orderBy('id', 'desc')->get();
        $personalities2 = Personality::orderBy('id', 'asc')->get();
        $alljobs2 = Job::orderBy('id', 'asc')->get();

        $before_age = null;
        $after_age = null;
        $prefecture = null;
        $before_body_height = null;
        $after_body_height = null;
        $body_figure = null;
        $smoke = null;
        $alcohol = null;
        $education = array();
        $housemate = null;
        $hobbies = array();
        $personalities = array();
        $jobs = array();
        $before_income = null;
        $after_income = null;
        $keyword = array();

        $data = [
            "me" => $authUser,
            "status" => $status,
            "users" => $users,
            "userCount" => $userCount,
            "auth_id" => $from_user_id,
            "hobbies2" => $hobbies2,
            "personalities2" => $personalities2,
            "alljobs2" => $alljobs2,
            "before_age" => $before_age,
            "after_age" => $after_age,
            "prefecture" => $prefecture,
            "before_body_height" => $before_body_height,
            "after_body_height" => $after_body_height,
            "body_figure" => $body_figure,
            "smoke" => $smoke,
            "alcohol" => $alcohol,
            "education" => $education,
            "housemate" => $housemate,
            "hobbies" => $hobbies,
            "personalities" => $personalities,
            "jobs" => $jobs,
            "before_income" => $before_income,
            "after_income" => $after_income,
            "keyword" => $keyword,
        ];
        return view('users.index', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(int $status = 0, Request $request)
    {
        // dd($request);
        $query = User::query();
        $authUser = Auth::user();
        switch ($authUser->sex){
            case Status::MAN:
                $query->where('sex', '=', Status::WOMAN);
                break;
            case Status::WOMAN:
                $query->where('sex', '=', Status::MAN);
                break;
            case Status::LGBT:
                $query->where('sex', '=', Status::LGBT);
        }


        // Viewにわたす変数初期化（ページングに必要）
        $before_age = null;
        $after_age = null;
        $prefecture = null;
        $before_body_height = null;
        $after_body_height = null;
        $body_figure = null;
        $smoke = null;
        $alcohol = null;
        $education = array();
        $housemate = null;
        $hobbies = array();
        $personalities = array();
        $jobs = array();
        $before_income = null;
        $after_income = null;
        $keyword = array();


        //filledメソッドを使用（値が存在、かつ空ではないか）
        // キーワード検索
        if($request->filled('keyword')) {
            $keyword = $request->keyword;
            foreach ($keyword as $value) {
                $query->where('name','like','%'.$value.'%')->orWhere('self_introduction','like','%'.$value.'%');
            }
        }
        
        // 年齢
        if($request->filled('before_age' , 'after_age')) {
            $before_age = $request->before_age;
            $after_age = $request->after_age;
            $beforeTime = new Carbon('-' . $before_age . 'years');
            $afterTime = new Carbon('-' . $after_age . 'years');
            $beforeTime->setDateTime($beforeTime->year, 1, 1, 0, 0, 0);
            $afterTime->setDateTime($afterTime->year, 1, 1, 0, 0, 0);
            $query->whereBetween('birth_date', [$afterTime, $beforeTime]);

        }elseif($request->filled('before_age')){
            $before_age = $request->before_age;
            $beforeTime = new Carbon('-' . $before_age . 'years');
            $beforeTime->setDateTime($beforeTime->year, 1, 1, 0, 0, 0);
            $query->where('birth_date', '<=', $beforeTime);

        }elseif($request->filled('after_age')){
            $after_age = $request->after_age;
            $afterTime = new Carbon('-' . $after_age . 'years');
            $afterTime->setDateTime($afterTime->year, 1, 1, 0, 0, 0);
            $query->where('birth_date', '>=', $afterTime);
        }

        // エリア
        if($request->filled('prefecture')) {
            $prefecture = $request->prefecture;
            $query->where('prefecture', '=', $prefecture);

        }

        // 身長
        if($request->filled('before_body_height' , 'after_body_height')) {
            $before_body_height = $request->before_body_height;
            $after_body_height = $request->after_body_height;
            $query->whereBetween('body_height', [$before_body_height, $after_body_height]);

        }elseif($request->filled('before_body_height')){
            $before_body_height = $request->before_body_height;
            $query->where('body_height', '>=', $before_body_height);

        }elseif($request->filled('after_body_height')){
            $after_body_height = $request->after_body_height;
            $query->where('body_height', '<=', $after_body_height);
        }

        // 体型
        if($request->filled('body_figure')) {
            $body_figure = $request->body_figure;
            $query->where('body_figure', '=', $body_figure);

        }

        // 喫煙
        if($request->filled('smoke')) {
            $smoke = $request->smoke;
            $query->where('smoke', '=', $smoke);

        }

        // 飲酒
        if($request->filled('alcohol')) {
            $alcohol = $request->alcohol;
            $query->where('alcohol', '=', $alcohol);

        }

        // 学歴
        if($request->filled('education')) {
            $education = $request->education;
            // dd($education);
            $query->whereIn('education', $education);

        }

        // 同居人
        if($request->filled('housemate')) {
            $housemate = $request->housemate;
            $query->where('housemate', '=', $housemate);

        }

        // 趣味
        if($request->filled('hobbies')) {
            $hobbies = $request->hobbies;

            foreach($hobbies as $hobbie) {
                $query->whereHas('hobbyId', function ($query) use ($hobbie) {
                    $query->where('hobby_id', '=', $hobbie);
                });

            }

        }

        // 性格
        if($request->filled('personalities')) {
            $personalities = $request->personalities;

            foreach($personalities as $personalitie) {
                $query->whereHas('personalityId', function ($query) use ($personalitie) {
                    $query->where('personality_id', '=', $personalitie);
                });

            }

        }

        // 職種
        if($request->filled('jobs')) {
            $jobs = $request->jobs;

            foreach($jobs as $job) {
                $query->whereHas('jobId', function ($query) use ($job) {
                    $query->where('job_id', '=', $job);
                });

            }

        }

        // 年収
        if($request->filled('before_income' , 'after_income')) {
            $before_income = $request->before_income;
            $after_income = $request->after_income;
            $query->whereBetween('income', [$before_income, $after_income]);

        }elseif($request->filled('before_income')){
            $before_income = $request->before_income;
            $query->where('income', '>=', $before_income);

        }elseif($request->filled('after_income')){
            $after_income = $request->after_income;
            $query->where('income', '<=', $after_income);
        }

        $users = $query->paginate(self::PAGE_COUNT);

        // 表示テスト用
        $status = 0;
        $userCount = $users->count();
        $from_user_id = $authUser->id;
        $hobbies2 = Hobby::orderBy('id', 'desc')->get();
        $personalities2 = Personality::orderBy('id', 'asc')->get();
        $alljobs2 = Job::orderBy('id', 'asc')->get();

        $data = [
            "me" => $authUser,
            "status" => $status,
            "users" => $users,
            "userCount" => $userCount,
            "auth_id" => $from_user_id,
            "hobbies2" => $hobbies2,
            "personalities2" => $personalities2,
            "alljobs2" => $alljobs2,
            "before_age" => $before_age,
            "after_age" => $after_age,
            "prefecture" => $prefecture,
            "before_body_height" => $before_body_height,
            "after_body_height" => $after_body_height,
            "body_figure" => $body_figure,
            "smoke" => $smoke,
            "alcohol" => $alcohol,
            "education" => $education,
            "housemate" => $housemate,
            "hobbies" => $hobbies,
            "personalities" => $personalities,
            "jobs" => $jobs,
            "before_income" => $before_income,
            "after_income" => $after_income,
            "keyword" => $keyword,
        ];
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
