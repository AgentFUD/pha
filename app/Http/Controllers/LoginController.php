<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        return $user->createToken('pha-token')->plainTextToken;
    }
}
