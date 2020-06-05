<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Reaction;
use Auth;
use App\Constants\Status;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Log;

class UserRepository
{
	const PAGE_COUNT = 4;

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
        return User::where('sex', '=', Status::WOMAN)->whereNotIn('id', $exclusionUsers)->paginate(self::PAGE_COUNT);
	}

	public static function getMen(int $authId)
    {
		// ライクユーザーとディスライクユーザーを抽出して、それ以外のユーザーを取得
		$likeUserIds = self::searchLike($authId);
		$disLikeUserIds = self::searchDisLike($authId);
		$exclusionUsers = array_merge($likeUserIds, $disLikeUserIds);
        return User::where('sex', '=', Status::MAN)->whereNotIn('id', $exclusionUsers)->paginate(self::PAGE_COUNT);
	}

	public static function getLGBT(int $authId)
    {
		// ライクユーザーとディスライクユーザーを抽出して、それ以外のユーザーを取得
		$likeUserIds = self::searchLike($authId);
		$disLikeUserIds = self::searchDisLike($authId);
		$exclusionUsers = array_merge($likeUserIds, $disLikeUserIds);
		return User::where('id', '!=', $authId)->where('sex', '=', Status::LGBT)->whereNotIn('id', $exclusionUsers)->paginate(self::PAGE_COUNT);
	}

	public static function getLike(int $authId)
    {
		$query = Reaction::query();
		$likeUsers = $query->select()->where('from_user_id', '=', $authId)->where('status', '=', Status::LIKE)->paginate(self::PAGE_COUNT);
		// dd($likeUsers);
		return $likeUsers;
	}

	public static function getDisLike(int $authId)
    {
		$query = Reaction::query();
		$likeUsers = $query->select()->where('from_user_id', '=', $authId)->where('status', '=', Status::DISLIKE)->paginate(self::PAGE_COUNT);
		return $likeUsers;

	}

	public static function getBeLiked(int $authId)
    {
		$query = Reaction::query();
		$likeUsers = $query->select()->where('to_user_id', '=', $authId)->where('status', '=', Status::LIKE)->paginate(self::PAGE_COUNT);
		// dd($likeUsers);
		return $likeUsers;

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

	public static function search($query)
    {
        return $query->paginate(self::PAGE_COUNT);
	}
}
