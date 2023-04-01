<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->with(['firearms' => function($q) {
            $q->with(['targets' => function($query) {
                    $query->withCount('scores');
                }]);
        }, 'targets', 'targetScores', 'checkIns'])->first();
//        $firearms = $user->firearms()
//            ->with(['targets' => function($query) {
//                $query->withCount('scores');
//            }])
//            ->get()
//            ->sortByDesc(function($firearm) {
//                return $firearm->targets->sum('scores_count');
//            });
        $membersIntroduced = User::whereNotNull('approved_at')->where('member_sponsor', $user->name)->count();

        return view('dashboard', [
            'user' => $user,
//            'firearms' => $firearms,
            'membersIntroduced' => $membersIntroduced,
        ]);
    }
}
