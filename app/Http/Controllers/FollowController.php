<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Http\Controllers\Auth;

class FollowController extends Controller
{
    public function ListFollower()
    {
        $followers = Follow::where('following_id', Auth::id())->get();
        $users = [];
        foreach($followers as $follower){
            array_push($users, $follower->user );
        }

        return view('homepage.list_follower', compact('users'));
    }

    public function ListFollowing()
    {
        $followers = Follow::where('user_id', Auth::id())->get();
        $users = [];
        foreach($followers as $follower){
            array_push($users, $follower->user );
        }

        return view('homepage.list_following', compact('users'));
    }

    public function follow( $id)
    {
        $followDataArray = array(
            "user_id" => Auth::id(),
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
