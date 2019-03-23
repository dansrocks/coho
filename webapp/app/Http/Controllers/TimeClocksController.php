<?php

namespace App\Http\Controllers;


/**
 * Class TimeClocksController
 *
 * @package App\Http\Controllers
 */
class TimeClocksController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clockIn()
    {
        $action = redirect(route('home'), 303);

        // @TODO to be implemented

        return $action;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clockOut()
    {
        $action = redirect(route('home'),303);

        // @TODO to be implemented

        return $action;
    }
}
