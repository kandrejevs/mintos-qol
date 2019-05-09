<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);


        if (Auth::guard()->attempt($request->only('email', 'password'))) {
            return User::where('email', $request->email)->first();
        }

        return abort(500);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

    }
}
