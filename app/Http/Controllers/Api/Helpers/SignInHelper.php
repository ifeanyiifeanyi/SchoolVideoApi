<?php


namespace App\Http\Controllers\Api\Helpers;

use App\Models\ActivationCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class SignInHelper {
    public $user, $password;
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }


    public function validateInputLogin(){
      
        $validator = Validator::make(
            [
                "user"      => $this->user,
                "password"      => $this->password
            ],
            [
                'user'      => ['required', 'string'],
                'password'      => ['required', 'string', Password::min(6)]
            ]
        );
        if($validator->fails()){
            return ['status' => false, 'message'=> $validator->messages()];
        }else{
            return ['status' => true];
        }
    }

    public function login($device_name){
        $validate = $this->validateInputLogin();
        if ($validate['status'] == false) {
            return $validate;
        }else{
            $user = User::where('username', $this->user)
                    ->orWhere('email',  $this->user)
                    ->orWhere('activation_code', $this->user)
                    ->first();
                    
            if($user){
                if($user->status === 1 && $user->is_email_verified === 1){
                    if(Hash::check($this->password, $user->password)){
                        $token = $user->createToken($device_name)->plainTextToken;
                        return ['status' => true,'username' => $user, 'token' => $token];
                    }else{
                        return ['status' => false, 'message' => 'incorrect password or username'];
                    }
                }else {
                    return ['status' => false, 'message' => "Account has not been activated, do well to contact us"];
                }
            }else{
                return ['status' => false, 'message' => 'Incorrect Credentials!'];
            }

        }
    }
}
?>