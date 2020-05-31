<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authUser = Auth::user();
        $id = $authUser->id;

        switch ($authUser->sex){
            case 0:
                $users = User::where('sex', '=', 1)->get();
                break;
            case 1:
                $users = User::where('sex', '=', 0)->get();
                break;
            default:
                // todo
                $users = User::where('id', '!=', $id)->where('sex', '=', 2)->get();
        }

        $userCount = $users->count();
        $from_user_id = $authUser->id;

        return view('home', compact('users', 'userCount', 'from_user_id'));
    }
}
