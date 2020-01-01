<?php

namespace App\Http\Controllers;
use App\Student;
use App\Marksheet;
use App\User;
use DB;
use Illuminate\Http\Request;

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
        $student_count  = DB::table('students')->count();
        $marksheet_count = DB::table('marksheets')->count();
        $user_count     = DB::table('users')->count();
        return view('home',compact('student_count','marksheet_count','user_count'));
    }
}
