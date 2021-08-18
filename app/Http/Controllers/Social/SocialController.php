<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\FileImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {

        $user = Socialite::driver('facebook')->user();
        $finduser = User::where('facebook_id', $user->id)->first();

        if ($finduser) {
            Auth::login($finduser);

            return redirect()->route('trangchu');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id' => $user->id,
                'password' => Hash::make('khuong123'),
            ]);

            FileImage::create([
                'imageable_type' => User::class,
                'imageable_id' => $newUser->id,
                'duongdan' => $user->avatar,
            ]);

            Auth::login($newUser);

            return redirect()->route('trangchu');
        }
    }


    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->route('trangchu');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('khuong123'),
                ]);

                FileImage::create([
                    'imageable_type' => User::class,
                    'imageable_id' => $newUser->id,
                    'duongdan' => $user->avatar,
                ]);

                Auth::login($newUser);
                return redirect()->route('trangchu');
            }
        
    }
}
