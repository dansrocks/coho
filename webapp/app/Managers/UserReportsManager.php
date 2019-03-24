<?php

namespace App\Managers;

use App\Models\TimeClock;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserReportsManager
 *
 * @package App\Managers
 */
class UserReportsManager
{
    /** @var User */
    private $user;

    /**
     * Constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Carbon $date
     *
     * @return Collection
     *
     * @throws \Exception
     */
    public function getDailyReport(Carbon $date)
    {
        $timeClocks = TimeClock::fromUser($this->getUser())
            ->fromDate($date)
            ->get();

        return $timeClocks;
    }

    /**
     * @return User
     */
    private function getUser()
    {
        return $this->user;
    }
}
