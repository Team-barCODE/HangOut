<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Constants\Status;
use App\Services\UserServices;
use App\Repositories\UserRepository;
use App\Services\ReportServices;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use Exception;
use Auth;
// use config\adminlte;

class HomeController extends Controller
{
    protected $repository;
    protected $userService;
    protected $reportService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServices $userService,ReportServices $reportService,UserRepository $repository)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->reportService = $reportService;
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authUser = Auth::user();

        $users = User::orderBy('id', 'asc')->get();
        $data = [
            'authUser'=>$authUser,
            'users' => $users,
        ];
        return view('admin.home', $data);   // 管理者用のテンプレート
    }

    public function report()
    {
        $authUser = Auth::user();
        // $reportedUsers = Report::orderBy('to_user_id','asc')->paginate(10);
        $reportedUsers = \App\Models\Report::select('to_user_id')->groupBy('to_user_id')->paginate();
        foreach($reportedUsers as $reportedUser){
            $hairetsu = [];

        }
        // $reportedUsersCount = \App\Models\Report::select('to_user_id')->paginate();
        $data = [
            'authUser'=>$authUser,
            'reportedUsers' => $reportedUsers,
            'reportedUsersCount' => $reportedUsersCount,
        ];
        return view('admin.menus.report', $data);   // 管理者用のテンプレート
    }





    public function reportDetail($id)
    {
        $authUser = Auth::user();
        $users = Report::where('to_user_id',$id)->paginate(10);
        $data = [
            'authUser'=>$authUser,
            'users' => $users,
        ];
        return view('admin.menus.reportDetail', $data);   // 管理者用のテンプレート
    }
}
