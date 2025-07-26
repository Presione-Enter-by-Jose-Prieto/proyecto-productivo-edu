<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        } else {
            $user->avatar = 'avatars/default-avatar.png';
        }
        
        $user->save();

        Auth::login($user);

        return redirect()->route('inicio');
    }

    public function login(Request $request){

        $credenciales = [
            'email' => $request -> email,
            'password' => $request -> password
        ];

        if(Auth::attempt($credenciales)){

            $request -> session()->regenerate();
            return redirect()->intended(route('inicio'));
        }else{
            return redirect()->route('login');
        }

    }


    public function logout(Request $request){
        Auth::logout();

        $request -> session()->invalidate();
        $request -> session()->regenerateToken();

        return redirect()->route('inicio');
    }
}
