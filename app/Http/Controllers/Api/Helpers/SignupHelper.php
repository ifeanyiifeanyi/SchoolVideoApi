<?php


namespace App\Http\Controllers\Api\Helpers;

use App\Models\ActivationCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;



class SignupHelper
{
    public $name, $username, $activation_code, $email, $password, $device;

    public function __construct($name, $username, $activation_code, $email, $password, $device)
    {
        $this->name = $name;
        $this->username = $username;
        $this->activation_code = $activation_code;
        $this->email = $email;
        $this->password = $password;
        $this->device = $device;
    }


    public function validateInputRegister()
    {
        $validator = Validator::make(
            [
                "name"              => $this->name,
                "username"          => $this->username,
                "activation_code"  => $this->activation_code,
                "email"             => $this->email,
                "password"          => $this->password
            ],
            [
                'name'                  => ['required', 'string'],
                'username'              => ['required', 'string', 'unique:users'],
                'activation_code'      => ['required', 'string'],
                'email'                 => ['required', 'email', 'unique:users'],
                'password'              => ['required', 'string', Password::min(6)]
            ]
        );

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->messages()];
        } else {
            return ['status' => true];
        }
    }

    public function register($device)
    {
        $validate = $this->validateInputRegister();

        if ($validate['status'] == false) {
            return $validate;
        }

        // check if the activation code is available
        $activationCode = ActivationCode::where('code', $this->activation_code)
            ->where('status', 0)->first();

        if(!$activationCode) {
            return ['status' => false, 'message' => 'Invalid registration code.'];
        }
        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'activation_code' => $this->activation_code,
            'email' => $this->email,
            'device' => $this->device,
            'password' => Hash::make($this->password)
        ]);

        if(!$user){
            return ['status' => false, 'message' => 'Registration Failed.'];
        }
        // if user was created update activation Code status to 1
        $activationCode->status = 1;
        $activationCode->save();
        
        $token = $user->createToken($device)->plainTextToken;
        return ['status' => true, 'token' => $token, 'user' => $user, 'user_id' => $user->id];


    }
}
