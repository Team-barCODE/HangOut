<?php

namespace App\Services;

use App\Models\User;
use Auth;
use App\Repositories\UserRepository;
use App\Constants\Status;

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

        return $users;
  	}
}
