<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Http\Controllers\Auth;

class FollowController extends Controller
{
    public function listFollower()
    {
        $users = User::join('follows', 'follows.following_id', '=', 'users.id')
                ->where('follows.following_id', Auth::id())->get();

        return view('homepage.list_follower', compact('users'));
    }

    public function listFollowing()
    {
        $users = User::join('follows', 'follows.following_id', '=', 'users.id')
                ->where('follows.user_id', Auth::id())->get();
       
        return view('homepage.list_following', compact('users'));
    }

    public function follow($id)
    {
        $followDataArray = array(
            "user_id" => Auth::(),
            "following_id" => $id,
        );
        Follow::create($followDataArray);

        return redirect()->route('follow.following')->with('message', trans('message.create_success'));
    }

    public function destroy($id)
    {
        Follow::where('user_id', Auth::id())
                ->where('following_id', $id)
                ->delete();

        return redirect()->route('follow.following')->with('message', trans('message.delete_success'));
    }
}
