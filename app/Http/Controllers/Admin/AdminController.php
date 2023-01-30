<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if (Auth::check()) {
            return view('admin.index');
        }
        return redirect()->route('login')->with('status', 'Access denied!!');
    }

    public function logout(){
        Session::flush();
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }
}
