<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;


class AuthController extends Controller
{
    use HasRoles;
    public function userLogin(Request $request): RedirectResponse
    {
       
       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)){
           
            return redirect()->route('tasks.index');
        }else{
            return redirect()->back();
        }
        
    
 
    
}
}