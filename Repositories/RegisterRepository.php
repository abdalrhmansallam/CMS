<?php
namespace App\Http\Repositories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterRepository
{

    public function rules(): array
    {
        return [
            "name" => ["required"],
            "username" => ["required", "unique:users"],
            "email" => ["required", "unique:users"],
            "password" => ["required"]
        ];
    }

    public function validation(Request $request){
        return Validator::make($request->all, $this->rules());
    }

    public function createUser(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->type = $request->type === "user" ? "u" : "p";
        $user->save();
//        $user = JWTAuth::authenticate($request->token);

    }

}
