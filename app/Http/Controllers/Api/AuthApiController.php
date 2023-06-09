<?php

namespace App\Http\Controllers\Api;

use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Api\Helpers\SignInHelper;
use App\Http\Controllers\Api\Helpers\SignupHelper;

class AuthApiController extends Controller
{
    public function signUp(Request $request)
    {

        $response = (new SignupHelper($request->name, $request->username, $request->activation_code, $request->email, $request->password, $request->deviceName))->register($request->deviceName);

        if (isset($response['user_id']) && !empty($response['user_id'])) {
            
            $user_id = $response['user_id'];

            $token = Str::random(64);

            UserVerify::create([
                'user_id' => $user_id,
                'token' => $token
            ]);

        }else {
            // user ID not found, return a response
            return response()->json(['status' => false, 'message' => 'User ID not found.']);
        }


        // Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
        //     $message->to($request->email);
        //     $message->subject("Email verification");
        // });

        if ($response) {
            return response()->json($response);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Registration failed'
            ], 422);
        }

    }
    public function login(Request $request)
    {
        $response = (new SignInHelper($request->user, $request->password))->login($request->deviceName);
        return response()->json($response);
    }
}