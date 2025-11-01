<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Files\FileController;
use App\Http\Controllers\Files\ImageController;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Messages;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;


class UserController extends Controller
{
    use Messages;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('auth:sanctum')->except('index', 'show');
    }


    public function index()
    {

        return $this->success_message(['data'=>UserResource::collection( User::paginate(5))],
            'users retrieved successfully',200);
    }


    public static function store(StoreUserRequest $request)
    {
        $image=null;

        $image= FileController::storeFile($request->file('image'),'images/users');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image,

        ]);

        return $user;
    }


    public function show(User $user)
    {

        return
            $this->success_message(new UserResource($user),'user found',200);


    }


    static function FindByEmail($email)
    {
        return User::where('email', $email)->first();
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $userData = $request->only('name', 'email');


        $user->image = FileController::updateFile($request->file('image'), $user->image,'images/users');
        $user->save();



        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return $this->success_message(new UserResource($user), 'User updated successfully', 200);
    }

    public function destroy( User $user)
    {

        $this->authorize('delete', $user);

        $user->delete();
        FileController::deleteFile($user->image,'images/users');
        PersonalAccessToken::where('tokenable_id', $user->id)->delete();//to delete all the tokens for the user
        return $this->success_message(null,'user deleted successfully', 200);
    }
}
