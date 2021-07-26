<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function __construct()
    {

    }

    
    public function SocialSignup($provider)
    {
        // Socialite will pick response data automatic 
        $user = Socialite::driver($provider)->stateless()->user();

        return response()->json($user);
    }
}
