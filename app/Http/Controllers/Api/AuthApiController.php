<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Helpers\SignupHelper;
use App\Http\Controllers\Controller;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthApiController extends Controller
{
    public function signUp(Request $request){

        $response = (new SignupHelper($request->name, $request->username, $request->activation_code, $request->email, $request->password, $request->deviceName))->register($request->deviceName);

        $user_id = $response['user_id'];

        $token = Str::random(64);


        UserVerify::create([
            'user_id' => $user_id,
            'token' => $token
        ]);

        // Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
        //     $message->to($request->email);
        //     $message->subject("Email verification");
        // });

        if($response){
            return response()->json($response);
        }else{
            return response()->json([
                'error' => 'Registration failed'
            ], 422);
        }

    }
}
