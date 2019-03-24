<?php

namespace App\Http\Controllers;

use App\Managers\UserReportsManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserReportsController
 *
 * @package App\Http\Controllers
 */
class UserReportsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Exception
     */
    public function showDailyReport()
    {
        /**
         *
         */
        $user = Auth::user();
        $today = new Carbon("today");
        $manager = new UserReportsManager($user);

        $timeClocks = $manager->getDailyReport($today);

        $content = [
            'today' => $today,
            'timeClocks' => $timeClocks,
        ];

        return view('users.reports.daily', $content);

    }
}
