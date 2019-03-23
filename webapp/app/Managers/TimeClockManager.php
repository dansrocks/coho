<?php

namespace App\Managers;

use App\Interfaces\ITimeClock;
use App\Models\ClockType;
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class TimeClockManager
 *
 * @package App\Managers
 */
class TimeClockManager
{
    public function clockIn(User $user, ClockType $type)
    {
        // @TODO to be implemented
    }

    public function clockOut(ITimeClock$timeClock)
    {
        // @TODO to be implemented
    }

    public function getCurrent(Auth $user)
    {
        // @TODO to be implemented
    }
}
