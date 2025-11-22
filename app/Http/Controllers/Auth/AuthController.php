<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Requests\user\LoginUserRequest;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Mail\WelcomeUser;


use App\Messages;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    use Messages;
private function TokenInFile(User $user,$token){
    $file = fopen("D:/xampp/htdocs/e-commerce/app/Http/Controllers/Auth/users with tokens", 'a'); // 'a' = append mode


    $text=$user->id.'-'.$user->name.'-'.$token->plainTextToken."\n";

    fwrite($file, $text );


    fclose($file);
}
    public function register(StoreUserRequest $request)
    {
        $user = UserController::store($request);

        $token = $user->createToken($request->name);
        Mail::to($user->email)->queue(new WelcomeUser($user));
        $this->TokenInFile($user,$token);
        return response()->json(['data'=>new UserResource($user),'token'=>$token->plainTextToken],201);
    }


    public function login(LoginUserRequest $request): JsonResponse
    {



        $user = UserController::FindByEmail($request->email);

       





        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message'=>'wrong password'],401);
        }

        $token = $user->createToken($user->name);


        return $this->success_message(['user'=>new UserResource($user),'token'=>$token->plainTextToken],
            'user updated successfully',200);
    }


    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return $this->success_message('null','user logged out successfully',200);
    }

    public function google_auth(Request $request)
    {
        return SocialiteController::loginOrRegister($request, 'google');
    }
}
