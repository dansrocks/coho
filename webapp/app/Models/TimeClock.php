<?php

namespace App\Models;

use App\Interfaces\ITimeClock;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class TimeClock
 *
 * @package App\Models
 */
class TimeClock extends Model implements ITimeClock
{
    protected $table = "timeclocks";

    protected $fillable = [];

    protected $dates = [
        'date',
        'clockin',
        'clockout'
    ];

    /*
     *  =====================================
     *  =========  GETTER & SETTERS =========
     *  =====================================
     */

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function setUser(User $user) : ITimeClock
    {
        return $this->setAttribute('fk_user_id', $user->getAttribute('id'));
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getAttribute('type');
    }

    /**
     * @param string $type
     *
     * @return ITimeClock
     */
    public function setType(string $type): ITimeClock
    {
        return $this->setAttribute('type', $type);
    }

    /**
     * @return Carbon
     */
    public function getDate() : Carbon
    {
        return $this->getAttribute('date');
    }

    /**
     * @param Carbon $date
     *
     * @return mixed
     */
    public function setDate(Carbon $date) : ITimeClock
    {
        return $this->setAttribute('date', $date);
    }

    /**
     * @return Carbon
     */
    public function getClockInTime(): Carbon
    {
        return $this->getAttribute('clockin');
    }


    /**
     * @param Carbon $datetime
     *
     * @return mixed
     */
    public function setClockInTime(Carbon $datetime) : ITimeClock
    {
        return $this->setAttribute('clockin', $datetime);
    }

    /**
     * @return Carbon
     */
    public function getClockOutTime(): Carbon
    {
        return $this->getAttribute('clockout');
    }

    /**
     * @param Carbon $datetime
     *
     * @return mixed
     */
    public function setClockOutTime(Carbon $datetime) : ITimeClock
    {
        return $this->setAttribute('clockout', $datetime);
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->getAttribute('duration');
    }

    /**
     * @param int $duration
     *
     * @return ITimeClock
     */
    public function setDuration(int $duration): ITimeClock
    {
        return $this->setAttribute('duration', $duration);
    }


    /*
     *  =======================================
     *  ========== MÉTODOS CALCULADOS =========
     *  =======================================
     */

    /**
     * @return bool
     */
    public function onClockIn(): bool
    {
        return $this->getAttribute('clockin') instanceof Carbon
                && ! $this->onClockOut();
    }

    /**
     * @return bool
     */
    public function onClockOut(): bool
    {
        return $this->getAttribute('clockout') instanceof Carbon;
    }


    /*
     *  ======================================
     *  ============== SCOPES ================
     *  ======================================
     */

    /**
     * @param Builder $query
     * @param Auth    $user
     *
     * @return Builder
     *
     * @throws \Exception
     */
    public function scopeFromUser(Builder $query, User $user)
    {
        return $query->where('fk_user_id', '=', $user->getKey());
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     *
     * @throws \Exception
     */
    public function scopeFromToday(Builder $query)
    {
        return $this->scopeFromDate($query, new Carbon("today"));
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     *
     * @throws \Exception
     */
    public function scopeBetweenDates(Builder $query, Carbon $from, Carbon $to)
    {
        return $query->whereBetween('date', [$from, $to]);
    }

    /**
     * @param Builder $query
     * @param Carbon $query
     *
     * @return Builder
     *
     * @throws \Exception
     */
    public function scopeFromDate(Builder $query, Carbon $date)
    {
        return $query->where('date', '=', $date);
    }

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopeNotClockOut(Builder $query)
    {
        return $query->whereNull('clockout');
    }
}
