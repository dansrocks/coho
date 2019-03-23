<?php

namespace App\Interfaces;

use App\User;
use Carbon\Carbon;

/**
 * Interface ITimeClock
 *
 * @package App\Interfaces
 */
interface ITimeClock
{
    const TYPE_WORKING = 'working';
    const TYPE_LUNCH = 'lunch';
    const TYPE_BREAK = 'break';
    const TYPE_OUT_OFF_OFFICE = 'outwork';

    /**
     * @param User $user
     *
     * @return ITimeClock
     */
    public function setUser(User $user) : ITimeClock;

    /**
     * @return string
     */
    public function getType() : string;

    /**
     * @param string type
     *
     * @return ITimeClock
     */
    public function setType(string $type) : ITimeClock;

    /**
     * @return Carbon
     */
    public function getDate() : Carbon;

    /**
     * @param Carbon $date
     *
     * @return ITimeClock
     */
    public function setDate(Carbon $date) : ITimeClock;

    /**
     * @return Carbon
     */
    public function getClockInTime() : Carbon;

    /**
     * @param Carbon $datetime
     *
     * @return ITimeClock
     */
    public function setClockInTime(Carbon $date) : ITimeClock;

    /**
     * @param Carbon $datetime
     *
     * @return ITimeClock
     */
    public function getClockOutTime() : Carbon;

    /**
     * @param Carbon $datetime
     *
     * @return ITimeClock
     */
    public function setClockOutTime(Carbon $datetime) : ITimeClock;

    /**
     * @return int
     */
    public function getDuration() : int;

    /**
     * @param int $duration
     *
     * @return ITimeClock
     */
    public function setDuration(int $duration) : ITimeClock;

    /**
     * @return bool
     */
    public function onClockIn() : bool;

    /**
     * @return bool
     */
    public function onClockOut() : bool;
}
