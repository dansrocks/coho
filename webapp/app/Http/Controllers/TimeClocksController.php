<?php

namespace App\Http\Controllers;

use App\Exceptions\OutdatedClockTime;
use App\Exceptions\UserAlreadyClockedIn;
use App\Exceptions\UserAlreadyClockedOut;
use App\Managers\TimeClockManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class TimeClocksController
 *
 * @package App\Http\Controllers
 */
class TimeClocksController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function clockIn(Request $request)
    {
        $this->validate($request, ['clocktype' => 'required|exists:clock_types,name']);

        $action = redirect(route('home'));
        try {
            $type = $request->get('clocktype');

            $manager = new TimeClockManager();
            $manager->clockIn(Auth::user(), $type);
            $action->with('timeclocks.success', 'Has fichado en ' . $type);

        } catch (UserAlreadyClockedIn $exception) {
            $action->withErrors("Ya estás fichado. No puedes fichar dos veces");
        }

        return $action;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Exception
     */
    public function clockOut()
    {
        $action = redirect(route('home'));

        $manager = new TimeClockManager();
        $clockTime = $manager->getCurrent(Auth::user());
        try {
            $manager->clockOut($clockTime);
            $action->with(
                'timeclocks.success',
                sprintf('Has finalizado el fichaje %s', $clockTime->getType())
            );

        } catch (OutdatedClockTime $exception) {
            $action->withErrors("No puedes fichar. Hay un registro pendiente.");

        } catch (UserAlreadyClockedOut $exception) {
            $action->withErrors("Error interno. No estás fichado");
        }

        return $action;
    }
}
