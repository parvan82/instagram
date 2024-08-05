<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function userProfile(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'bio' => 'required|max:255',
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json($user, 200);

    }


    public function follow(User $user)
    {
        $authUser = Auth::user();

        if (!$authUser->follow()->where('following_id', $user->id)->exists()) {
            $authUser->follow()->attach($user->id);
            return response()->json(['message' => 'Followed successfully'], 200);
        }

        return response()->json(['message' => 'Already following this user'], 200);
    }

    public function unfollow(User $user)
    {
        $authUser = Auth::user();

        if ($authUser->follow()->where('following_id', $user->id)->exists()) {
            $authUser->follow()->detach($user->id);
            return response()->json(['message' => 'Unfollowed successfully'], 200);
        }

        return response()->json(['message' => 'Not following this user'], 200);
    }

    public function followers(User $user)
    {
        $followers = $user->followers;
        return response()->json($followers, 200);
    }

    public function following(User $user)
    {
        $following = $user->follow;
        return response()->json($following, 200);
    }
}
