<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
//model
use App\Models\Status;
use App\Models\Profile;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function getregister(){
        return view('auth/register');
    }

    public function getforgotpassword(){
        return view('auth/reset-password');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'agreeTerms' => 'accepted'
        ]);
    
        $user = User::create([
            'name' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        // any additional logic to handle the newly registered user
    
        return redirect('/')->with('success', 'Registration successful!');
    }

    public function registersuccess()
    {

        return view('auth/registersuccess');
    }
    public function contactadmin()
    {

        return view('auth/forgot-password');
    }
}
