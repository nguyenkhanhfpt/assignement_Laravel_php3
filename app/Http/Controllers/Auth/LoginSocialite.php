<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\User;
use Hash;

class LoginSocialite extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();

        $user = $this->findOrCreate($getInfo, $provider);

        auth()->login($user);

        if ($user->role == 1) {
            return redirect()->route('admin');
        } else {
            return redirect()->route('home');
        }
    }

    public function findOrCreate($info, $provider)
    {
        $user = User::where('provider_id', $info->id)->first();

        if (!$user) {
            User::create([
                'id_member' => $info->id,
                'name_member' => $info->name,
                'email' => $info->email,
                'password' => Hash::make($info->id),
                'provider_id' => $info->id,
                'provider_name' => $provider,
                'phone_number' => null,
                'address' => null,
                'gender'=> null
            ]);

            $user = User::where('provider_id', $info->id)->first();
        }

        return $user;
    }
}
