<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RegisterRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $repository;
    public function __construct(RegisterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(Request $request){
        $valid = $this->repository->validation($request);
        if($valid->fails()){
            return response()->json([$valid->errors()->messages()], 400);
        }
        $this->repository->createUser($request);
    }
}
