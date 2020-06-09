<?php

namespace App\Services;

use App\Models\User;
use App\Models\Report;
use Auth;
use App\Constants\Status;

class ShowServices
{

	public static function genderCheck($id)
	{
    $user = User::findorFail($id);
    $authUser = Auth::user();
    if($user->id === $authUser->id)
    {
      return true;
    }
    else
    {
      switch($user->sex !== $authUser->sex)
      {
        case true:
          if($user->sex !== 2 && $authUser->sex !== 2)
          {
            return true;
          }
          break;
        case false:
          if($user->sex === 2 && $authUser->sex === 2)
          {
            return true;
          }
          break;
        default:
          return false;
          break;
      }
    }
  }

  public static function blockToCheck($id)
  {
    $user = User::findorFail($id);
    // 通報をしたことがあるか(現在の話ではない)
    // ブロック解除するにしても通報履歴を残す為に必要
    $blockToCheck = $user->reportToUser->where( 'to_user_id', $user->id )->where( 'from_user_id', Auth::id() )->isNotEmpty();
    // 通報をしたことがある場合
    if($blockToCheck === true)
    {
      // 現在の通報レベルを取得
      // (解除なのか通報なのかボタンフラグを分ける)
      $blocklevel = $user->reportToUser->where( 'to_user_id', $user->id )->where( 'from_user_id', Auth::id() )->first()->report_level;
      return $blocklevel;
    }
  }
  public static function blockToDetail($id)
  {
    $user = User::findorFail($id);

    // 通報をしたことがあるか(過去の実績)
    // ブロック解除するにしても通報履歴を残す為に必要
    $blockToCheck = $user->reportToUser->where( 'to_user_id', $user->id )->where( 'from_user_id', Auth::id() )->isNotEmpty();
    // 通報をしたことがある場合
    if($blockToCheck === true)
    {
      // 現在の通報内容を取得
      // (解除なのか通報なのかボタンフラグを分ける)
      $blockdetail = $user->reportToUser->where( 'to_user_id', $user->id )->where( 'from_user_id', Auth::id() )->first()->report_detail;
      return $blockdetail;

    }
  }




  public static function blockfromcheck($id)
  {
    $user = User::findorFail($id);

    // 通報をされたことがあるか(過去の実績)
    // ブロック解除されているにしても通報履歴を残す為に必要
    $blockfromcheck = $user->reportFromUser->where( 'from_user_id', $user->id )->where( 'to_user_id', Auth::id() )->isNotEmpty();
    // 通報をされたことがある場合
    if($blockfromcheck === true)
    {
      // 現在の通報レベルを取得
      // (解除されているのかレベルでフラグを分ける)
      $blockfromlevel = $user->reportFromUser->where( 'from_user_id', $user->id )->where( 'to_user_id', Auth::id() )->first()->report_level;
      return $blockfromlevel;
    }
  }





  public static function likeTo($id)
  {
    $user = User::findorFail($id);
    // 自分がライクしているか
    $likeTo = $user->toUserId->where( 'from_user_id', Auth::id() )->isNotEmpty();
    return $likeTo;
  }
  public static function likeFrom($id)
  {
    $user = User::findorFail($id);
    // 相手からライクされているか
    $likeFrom = $user->FromUserId->where( 'from_user_id', $user->id )->isNotEmpty();
    return $likeFrom;
  }

}
