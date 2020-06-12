<?php

namespace App\Services;

use App\Models\User;
use App\Models\Report;
use Auth;
use App\Constants\Status;

class ReportServices
{

  // ブロックしているかを返す(0 ならブロックされていない)
  public static function blockToCheck($id ) :int
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
    return 0;
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

  // ブロックされているかを返す(0 ならブロックされていない)
  public static function blockfromcheck($id) :int
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
    return 0;

  }






}
