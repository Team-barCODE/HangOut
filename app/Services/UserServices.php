<?php

namespace App\Services;

use App\Models\User;
use Auth;
use App\Repositories\UserRepository;
use App\Constants\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Hobby;
use App\Models\HobbyUser;
use App\Models\Personality;
use App\Models\PersonalityUser;
use App\Models\Job;
use App\Models\JobUser;

class UserServices
{

	public static function getList(int $status)
	{
        $authUser = Auth::user();
        $authUserId = $authUser->id;

		switch ($status){
            case 1:
                //   「好き」一覧
                $users = UserRepository::getLike($authUserId);
                break;

            case 2:
                //   「嫌い」一覧
                $users = UserRepository::getDisLike($authUserId);
                break;

            case 3:
                //   「ライクされている」一覧
                $users = UserRepository::getBeLiked($authUserId);
                break;

            default:
                //   一覧
                switch ($authUser->sex){
                    case Status::MAN:
                        $users = UserRepository::getWomen($authUserId);
                        // dd($users);
                        break;
                    case Status::WOMAN:
                        $users = UserRepository::getMen($authUserId);
                        break;
                    case Status::LGBT:
                        // todo
                        $users = UserRepository::getLGBT($authUserId);
                }
        }

        // 表示テスト用
        $userCount = $users->total();
        $from_user_id = $authUser->id;
        $hobbiesMaster = Hobby::orderBy('id', 'desc')->get();
        $personalitiesMaster = Personality::orderBy('id', 'asc')->get();
        $jobsMaster = Job::orderBy('id', 'asc')->get();

        $search = null;
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
            "search" => $search,
            "users" => $users,
            "userCount" => $userCount,
            "auth_id" => $from_user_id,
            "hobbiesMaster" => $hobbiesMaster,
            "personalitiesMaster" => $personalitiesMaster,
            "jobsMaster" => $jobsMaster,
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

        return $data;
    }

    public static function search($authUser, $request)
	{
		$query = User::query();
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


        //filledメソッドを使用（値が存在、かつ空ではないか）
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

        $keyword = $request->keyword;
        $searchWord = [];

        if (!empty($keyword)){
            // +を半角スペースに変換（GETメソッド対策）
            $keyword = str_replace('+', ' ', $keyword);
            // 全角スペースを半角スペースに変換
            $keyword = str_replace('　', ' ', $keyword);
            // %はSQL実行時にLIKEのパラメータとして使うのでスペースにする。
            $keyword = str_replace('%', ' ', $keyword);
            // 取得したキーワードのスペースの重複を除く。
            $keyword = preg_replace('/\s(?=\s)/', '', $keyword);
            // キーワード文字列の前後のスペースを削除する
            $keyword = trim($keyword);

            if (!empty($keyword) || $keyword !== '') {
                // 半角カナを全角カナへ変換
                $keyword = mb_convert_kana($keyword, 'KV');
                // 半角スペースで配列にし、重複は削除する
                $searchWord = array_unique(explode(' ', $keyword));
            }
        }

        // キーワード検索
        if(!empty($searchWord)) {
            switch ($request->search){
                case Status::SEARCH_NAME:
                    foreach ($searchWord as $value) {
                        $query->where('name','like','%'.$value.'%');
                    }
                    break;
                case Status::SEARCH_INTRODUCTION:
                    foreach ($searchWord as $value) {
                        $query->where('self_introduction','like','%'.$value.'%');
                    }
                    break;
            }

        }

        

        $users = UserRepository::search($query);
        // $users = $query->toSql();
        // var_dump($users);
        // exit;

        // 表示テスト用
        $status = 0;
        $search = $request->search;
        $userCount = $users->total();
        $from_user_id = $authUser->id;
        $hobbiesMaster = Hobby::orderBy('id', 'desc')->get();
        $personalitiesMaster = Personality::orderBy('id', 'asc')->get();
        $jobsMaster = Job::orderBy('id', 'asc')->get();

        $data = [
            "me" => $authUser,
            "status" => $status,
            "search" => $search,
            "users" => $users,
            "userCount" => $userCount,
            "auth_id" => $from_user_id,
            "hobbiesMaster" => $hobbiesMaster,
            "personalitiesMaster" => $personalitiesMaster,
            "jobsMaster" => $jobsMaster,
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
        return $data;
    }

    // 詳細ページの性別判定分岐
    // UserControllerのshowに渡してtrueならデータ渡す
    public static function genderCheck($id)
	{
        $user = User::findorFail($id);
        $authUser = Auth::user();
        // マイページならtrue
        if($user->id === $authUser->id)
        {
            return true;
        }
        // 性別がuserとログインユーザの性別が違う場合
        elseif($user->sex !== $authUser->sex)
        {
            // 性別がuserとログインユーザが両方ともLGBTではない場合はtrue
            if($user->sex !== Status::LGBT && $authUser->sex !== Status::LGBT)
            {
                return true;
            }
        }
        // 性別がuserとログインユーザが両方ともLGBTである場合はtrue
        elseif($user->sex === $authUser->sex && $authUser->sex === Status::LGBT) 
        {
            return true;
        }
        // それ以外は全部false
        return false;
    }

    public static function likeTo($id)
    {
        $user = User::findorFail($id);
        // likeかdislikeをした実績があるかをチェック
        $toStatusExistCheck = $user->toUserId->where( 'from_user_id', Auth::id() )->where('to_user_id',$user->id)->isNotEmpty();
        // 自分がライクしているか
        if($toStatusExistCheck === true && $user->id !== Auth::id() ){
            $likeTo = $user->toUserId->where( 'from_user_id', Auth::id() )->where('to_user_id',$user->id)->first()->status;
            if($likeTo === Status::LIKE){
                return true;
            }
        }
        return false;
    }
    public static function likeFrom($id)
    {
        $user = User::findorFail($id);
        // likeかdislikeをした実績があるかをチェック
        $fromStatusExistCheck = $user->FromUserId->where( 'from_user_id', $user->id )->where('to_user_id',Auth::id())->isNotEmpty();
        // 相手からライクされているか
        if($fromStatusExistCheck === true && $user->id !== Auth::id()){
            $likeFrom = $user->FromUserId->where( 'from_user_id', $user->id )->where('to_user_id',Auth::id())->first()->status;
            if($likeFrom === Status::LIKE){
                return true;
            }
        }
        return false;

    }


}
