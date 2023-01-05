<?php

namespace ArtMin96\FilamentTributeJs\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function mention(Request $request)
    {
        if ($request['query']) {
            $users = User::select([
                'id',
                'username',
                'name',
                'last_name',
                DB::raw('false as is_following')
            ])
                ->search($request['query'])
                ->take(10)
                ->get()
                ->each(function ($user) {
                    $user['is_following'] = filamentSocial()->currentUser()->isFollowing($user);
                    return $user;
                });
        } else {
            $users = '';
        }

        return $users;
    }
}
