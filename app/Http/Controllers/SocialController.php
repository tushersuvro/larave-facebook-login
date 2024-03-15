<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    function facebookRedirect(){
        return Socialite::driver('facebook')->redirect();
    }

    function facebookCallback(){
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user);

        return redirect()->route('dashboard');
    }

    function _registerOrLoginUser($data)
    {
        $user = User::where('facebook_id', $data->id)->first();

        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->facebook_id = $data->id;
            $user->password = encrypt('password');
            $user->save();
        }

        Auth::login($user);
    }
}
