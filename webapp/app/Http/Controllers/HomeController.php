<?php

namespace App\Http\Controllers;

use App\Interfaces\ITimeClock;
use App\Managers\ClockTypesManager;
use App\Managers\TimeClockManager;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index()
    {
        $manager = new TimeClockManager();
        $clockTypesManager = new ClockTypesManager();

        $timeClock = $manager->getCurrent(Auth::user());
        $content = [
            'timeClock' => $timeClock,
            'clockTypes' => $clockTypesManager->getTypes(),
            'clockImage' => $this->getTimeClockImage($timeClock),
        ];

        return view('home', $content);
    }


    /**
     * @param ITimeClock|null $timeClock
     *
     * @return string
     */
    private function getTimeClockImage($timeClock)
    {
        if (! $timeClock instanceof ITimeClock) {
            $image = 'out-of-office-time';
        } elseif ($timeClock->getType() == ITimeClock::TYPE_WORKING) {
            $image = 'working-time';
        } elseif ($timeClock->getType() == ITimeClock::TYPE_LUNCH) {
            $image = 'lunch-time';
        } elseif ($timeClock->getType() == ITimeClock::TYPE_BREAK) {
            $image = 'break-time';
        } else {
            $image = 'thinking-time';
        }

        return $image;
    }
}
