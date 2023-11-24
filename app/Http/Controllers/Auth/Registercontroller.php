<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class Registercontroller extends Controller
{
    public function register(){
        return view('Auth.register');
    }
    public function store(UserRequest $request){
        $validate = $request->validated();
        $user = User::create($validate);
        $user->assignRole('executive');
        

        return redirect('login');

    }
    public function login(){
        return view('Auth.login');
    }
}