<?php

namespace App\Http\Controllers;

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
    const IMAGE_OUT_OF_WORK = '';
    const IMAGE_WORKING = '';
    const IMAGE_LUNCH = '';
    const IMAGE_BREAK = '';
    const IMAGE_OTHER = '';

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
        ];

        return view('home', $content);
    }
}
