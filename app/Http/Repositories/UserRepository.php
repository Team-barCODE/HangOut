<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Reaction;
use Auth;
use App\Constants\Status;

class UserRepository
{

	public static function getAll()
    {
        return User::all();
	}

	public static function getWomen()
    {
        return User::where('sex', '=', Status::WOMAN)->get();
	}

	public static function getMen()
    {
        return User::where('sex', '=', Status::MAN)->get();
	}

	public static function getLGBT(int $id)
    {
		return User::where('id', '!=', $id)->where('sex', '=', Status::LGBT)->get();
	}

	public static function getLike(int $authId)
    {
		$query = Reaction::query();
		$likeUsers = $query->select('to_user_id')->where('from_user_id', '=', $authId)->where('status', '=', Status::LIKE)->get();

		$userIds = array();
		foreach ($likeUsers as $user) {
			$userIds[] += $user->to_user_id;
		}
		// dd($userIds);
		$users = User::find($userIds);
        return $users;
	}

	public static function getDisLike(int $authId)
    {
		$query = Reaction::query();
		$likeUsers = $query->select('to_user_id')->where('from_user_id', '=', $authId)->where('status', '=', Status::DISLIKE)->get();

		$userIds = array();
		foreach ($likeUsers as $user) {
			$userIds[] += $user->to_user_id;
		}
		// dd($userIds);
		$users = User::find($userIds);
        return $users;

	}
}
