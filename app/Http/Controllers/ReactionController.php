<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reaction;
use App\Constants\Status;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;

class ReactionController extends Controller
{
    public function create(Request $request)
    {
        // Log::debug($request);

        $to_user_id = $request->to_user_id;
        $like_status = $request->reaction;
        $from_user_id = $request->from_user_id;

        $exists = Reaction::where([
            ['to_user_id', $to_user_id],
            ['from_user_id', $from_user_id]
            ])->exists();

        if($exists) {
            Reaction::where([
                ['to_user_id', $to_user_id],
                ['from_user_id', $from_user_id]
                ])->delete();
        }

        if ($like_status === 'like'){
            $status = Status::LIKE;
        }else{
            $status = Status::DISLIKE;
        }

        try {
            DB::beginTransaction();

            $reaction = new Reaction();
            $reaction->to_user_id = $to_user_id;
            $reaction->from_user_id = $from_user_id;
            $reaction->status = $status;

            $reaction->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }

    }
}
