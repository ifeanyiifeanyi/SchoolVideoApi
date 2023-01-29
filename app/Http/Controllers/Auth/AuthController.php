<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        $this->validate($request, [
            'name'      => 'required|string|min:3|max:199',
            'username'  => 'required|string|min:3|max:199|unique:users',
            'email'     => 'required|email:rfc,dns|min:3|max:199|unique:users',
            'password'  => 'required|min:6|max:10|confirmed'
        ]);

        $user = new User();

        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = Str::random(64);
        UserVerify::create([
            'user_id' => $user->id,
            'token'   => $token
        ]);

        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject("Email verification");
        });

       return redirect()->route('login')->with('message', 'Registration was successful, Please check your email for account verification');
    }

    public function loginView(){
        return view('auth.login');
    }
    public function login(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'login'     => 'required|min:2',
            'password'  => 'required'
        ]);
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([
            $loginType => $request->login
        ]);
        //check for login attempts
        if(RateLimiter::tooManyAttempts(request()->ip(), 3)){
            return back()->with('status', 'Too many failed attempts, IP has been restricted!');
        }
        if(!Auth::guard('web')->attempt($request->only($loginType, 'password'), $request->remember, true)){
            // block ip for 1min
            RateLimiter::hit(request()->ip(), 60);
            return back()->with('status', 'Invalid Credentials');
        }
        RateLimiter::clear(request()->ip());
        $notification = [
            'message'       => 'Login Successful',
            'alert-type'    => 'success'
        ];
        return redirect()->route('dashboard')->with($notification);
    }

    public function verifyAccount($token){
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = "Sorry, your email could not be identified";

        if(!is_null($verifyUser)){
            $user = $verifyUser->user;

            if(!$user->is_email_verified){
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();

                $message = "Your email is now verified. You can login";
            }else {
                $message = "Your email is already verified, continue to login";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }



    

}