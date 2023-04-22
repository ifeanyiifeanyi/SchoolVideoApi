<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivationCode;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class ManageUsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function verify($id)
    {
        $codes = ActivationCode::where('status', 0)->get();
        $user = User::findOrFail($id);

        return view('admin.users.verify', compact('codes', 'user'));

    }

    public function verifyUpdate(Request $request)
    {
        // dd($request);

        $request->validate([
            'activation_code' => 'required'
        ]);

        $check_code = ActivationCode::where('code', $request->activation_code)
            ->where('status', 0)->first();

        $user = User::where('id', $request->user_id)
            ->where('status', 0)
            ->whereNull('email_verified_at')
            ->where('is_email_verified', 0)
            ->first();

        if ($check_code && $user) {
            // Update the user's information
            $user->status = 1;
            $user->email_verified_at = now();
            $user->is_email_verified = 1;
            $user->activation_code = $check_code->code;
            $user->save();

            // save verification details
            $token = Str::random(64);
            UserVerify::create([
                'user_id' => $request->user_id,
                'token' => $token
            ]);

            // update the code details
            $check_code->status = 1;
            $check_code->save();

            $notification = [
                'message' => 'User Account Verified!',
                'alert-type' => 'success'
            ];

            return redirect()->route('manage.users')->with($notification);
        } else {
            $notification = [
                'message' => 'Verification Failed!',
                'alert-type' => 'danger'
            ];

            return redirect()->route('manage.users')->with($notification);
        }


    }

    public function Unverified($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            // delete used activation code before remove the code from user account
            ActivationCode::where('code', $user->activation_code)
                ->where('status', 1)->delete();


            // Update the user's information
            $user->status = 0;
            $user->email_verified_at = null;
            $user->is_email_verified = 0;
            $user->activation_code = null;
            $user->save();



            // delete verification details
            UserVerify::where('user_id', $id)->delete();
            $notification = [
                'message' => 'User Account Suspended, Activation Code Deleted!',
                'alert-type' => 'success'
            ];

            return redirect()->route('manage.users')->with($notification);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            $notification = [
                'message' => 'User not found!',
                'alert-type' => 'warning'
            ];
            return redirect()->route('manage.users')->with($notification);
        }

        // delete activation code before user Account
        ActivationCode::where('code', $user->activation_code)
        ->where('status', 1)->delete();

        // then delete user account
        $user->delete();
        $notification = [
            'message' => 'User Deleted!',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage.users')->with($notification);
    }
}