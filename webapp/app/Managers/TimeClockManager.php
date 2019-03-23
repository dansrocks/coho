<?php

namespace App\Managers;

use App\Exceptions\OutdatedClockTime;
use App\Exceptions\UserAlreadyClockedIn;
use App\Exceptions\UserAlreadyClockedOut;
use App\Interfaces\ITimeClock;
use App\Models\TimeClock;
use App\User;
use Carbon\Carbon;

/**
 * Class TimeClockManager
 *
 * @package App\Managers
 */
class TimeClockManager
{
    /**
     * @param string $type
     *
     * @throws UserAlreadyClockedIn
     */
    public function clockIn(User $user, string $type)
    {
        $now = new Carbon("now");

        if ($this->getCurrent($user) instanceof ITimeClock) {
            throw new UserAlreadyClockedIn();
        }

        $timeClock = (new TimeClock())
            ->setUser($user)
            ->setType($type)
            ->setDate($now)
            ->setClockInTime($now);

        $this->saveTimeClock($timeClock);
    }

    /**
     * @param ITimeClock $timeClock
     *
     * @throws OutdatedClockTime
     * @throws UserAlreadyClockedOut
     */
    public function clockOut(ITimeClock$timeClock)
    {
        $now = new Carbon("now");
        $today = (clone($now))->setTime(0, 0,  0);

        if ($timeClock->getDate() < $today) {
            throw new OutdatedClockTime();
        }

        if ($timeClock->onClockOut()) {
            throw new UserAlreadyClockedOut();
        }

        $timeClock->setClockOutTime($now);
        $duration = $timeClock->getClockOutTime()
                        ->diffInSeconds($timeClock->getClockInTime());
        $timeClock->setDuration($duration);

        $this->saveTimeClock($timeClock);
    }

    /**
     * @return ITimeClock
     *
     * @throws \Exception
     */
    public function getCurrent(User $user)
    {
        $current = TimeClock::fromUser($user)->fromToday()->notClockOut()->first();

        return $current;
    }

    /**
     * @param ITimeClock $timeClock
     */
    private function saveTimeClock(ITimeClock $timeClock): void
    {
        /** @var TimeClock $timeClock */
        $timeClock->save();
    }
}
