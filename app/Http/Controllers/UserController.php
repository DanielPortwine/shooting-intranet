<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::where('id', $id)->with(['firearms' => function($q) {
            $q->with(['targets' => function($query) {
                $query->withCount('scores');
            }]);
        }, 'targets', 'targetScores', 'checkIns'])->first();

        $membersIntroduced = User::whereNotNull('approved_at')->where('member_sponsor', $user->name)->count();

        return view('profile', [
            'user' => $user,
            'membersIntroduced' => $membersIntroduced,
        ]);
    }
}
