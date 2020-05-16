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

	public static function getWomen(int $authId)
    {
		// ライクユーザーとディスライクユーザーを抽出して、それ以外のユーザーを取得
		$likeUserIds = self::searchLike($authId);
		$disLikeUserIds = self::searchDisLike($authId);
		$exclusionUsers = array_merge($likeUserIds, $disLikeUserIds);
        return User::where('sex', '=', Status::WOMAN)->whereNotIn('id', $exclusionUsers)->get();
	}

	public static function getMen(int $authId)
    {
		// ライクユーザーとディスライクユーザーを抽出して、それ以外のユーザーを取得
		$likeUserIds = self::searchLike($authId);
		$disLikeUserIds = self::searchDisLike($authId);
		$exclusionUsers = array_merge($likeUserIds, $disLikeUserIds);
        return User::where('sex', '=', Status::MAN)->whereNotIn('id', $exclusionUsers)->get();
	}

	public static function getLGBT(int $authId)
    {
		// ライクユーザーとディスライクユーザーを抽出して、それ以外のユーザーを取得
		$likeUserIds = self::searchLike($authId);
		$disLikeUserIds = self::searchDisLike($authId);
		$exclusionUsers = array_merge($likeUserIds, $disLikeUserIds);
		return User::where('id', '!=', $authId)->where('sex', '=', Status::LGBT)->whereNotIn('id', $exclusionUsers)->get();
	}

	public static function getLike(int $authId)
    {
		$userIds = self::searchLike($authId);
		$users = User::find($userIds);
        return $users;
	}

	public static function getDisLike(int $authId)
    {
		$userIds = self::searchDisLike($authId);
		$users = User::find($userIds);
        return $users;

	}

	public static function searchLike(int $authId)
    {
		$query = Reaction::query();
		$likeUsers = $query->select('to_user_id')->where('from_user_id', '=', $authId)->where('status', '=', Status::LIKE)->get();

		$userIds = array();
		foreach ($likeUsers as $user) {
			$userIds[] += $user->to_user_id;
		}
        return $userIds;
	}

	public static function searchDisLike(int $authId)
    {
		$query = Reaction::query();
		$likeUsers = $query->select('to_user_id')->where('from_user_id', '=', $authId)->where('status', '=', Status::DISLIKE)->get();

		$userIds = array();
		foreach ($likeUsers as $user) {
			$userIds[] += $user->to_user_id;
		}
        return $userIds;
	}
}
