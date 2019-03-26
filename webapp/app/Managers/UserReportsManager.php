<?php

namespace App\Managers;

use App\Models\TimeClock;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
     * @param Carbon $date
     *
     * @return Collection
     *
     * @throws \Exception
     */
    public function getClocksGroupedByType(Carbon $from, Carbon $to)
    {
        $timeClocks = TimeClock::select(
                'date',
                'type',
                DB::raw('count(*) as clocks'),
                DB::raw('sum(duration) as duration')
            )
            ->fromUser($this->getUser())
            ->betweenDates($from, $to)
            ->groupBy('date', 'type')
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
