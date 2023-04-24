<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Categories;
use App\Models\VideoContent;
use Illuminate\Http\Request;
use App\Models\ActivationCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users = User::whereNotIn('username', ['admin', 'Admin'])->count();
        $activeCode = ActivationCode::where('status', 1)->count();
        $availableCodes = ActivationCode::where('status', 0)->count();
        $videos = VideoContent::count();
        $categories = Categories::count();
        $totalVideoViews = VideoContent::sum('views');
        $totalVideoLikes = VideoContent::sum('likes');
        // dd($users);


        if (Auth::check()) {
            return view('admin.index', compact('users', 'activeCode', 'availableCodes', 'videos', 'categories', 'totalVideoViews', 'totalVideoLikes'));
        }
        return redirect()->route('login')->with('status', 'Access denied!!');
    }

    public function logout(){
        Session::flush();
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }
}
