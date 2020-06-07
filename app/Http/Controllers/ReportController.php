<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Constants\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'to_user_id' => ['required', 'int','min:1'],
            'from_user_id' => ['required', 'int','min:1'],
            'report_level' => ['required', 'int', 'digits_between:1,4'],
            'report_detail' => ['required','string','min:1','max:200'],
        ]);
    }

    //
    public function report(Request $request)
    {
        // $user = User::findorFail($id);


        $to_user_id = $request->to_user_id;
        $from_user_id = $request->from_user_id;
        $report_level = $request->report_level;
        $report_detail = $request->report_detail;

        $exists = Report::where([
            ['to_user_id', $to_user_id],
            ['from_user_id', $from_user_id],
            ])->exists();

        if($exists) {
            Report::where([
                ['to_user_id', $to_user_id],
                ['from_user_id', $from_user_id],
                ])->delete();
        }

        switch($report_level)
        {
            case 0:
                $level = Status::REPORT_ZERO;
                break;

            case 1:
                $level = Status::REPORT_ONE;
                break;

            case 2:
                $level = Status::REPORT_TWO;
                break;

            case 3:
                $level = Status::REPORT_THREE;
                break;

            case 4:
                $level = Status::REPORT_FOUR;
                break;
        }

        try {
            DB::beginTransaction();

            $reports = new Report();
            $reports->to_user_id = $to_user_id;
            $reports->from_user_id = $from_user_id;
            $reports->report_level = $level;
            $reports->report_detail = $report_detail;

            $reports->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }

    }
    
}
