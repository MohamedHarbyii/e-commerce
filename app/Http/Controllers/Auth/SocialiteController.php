<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class SocialiteController extends Controller
{
    /************************************************
     $driver: is the provider the u will sign in for
     *************************************************/
    public static function loginOrRegister(Request $request,$driver)
    {
        self::validateProvider($driver);
        $request->validate([
            'token' => 'required',
        ]);


        try {

            $User = Socialite::driver($driver)->stateless()->userFromToken($request->token);


            $user = User::where('email', $User->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'name' => $User->getName(),
                    'email' => $User->getEmail(),
                    'google_id' => $User->getId(),
                    'password' => bcrypt(str()->random(12)),
                ]);
            }


            $token = $user->createToken($user->name)->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => new UserResource($user),
                'token' => $token,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Invalid Google token',
                'details' => $e->getMessage(),
            ], 401);
        }
    }
    protected static function validateProvider($provider)
    {

        if (!in_array($provider, ['google']))
        {
            throw ValidationException::withMessages([
                'provider' => 'Provider not supported.',
            ]);
        }
    }
}
