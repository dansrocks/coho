<?php

namespace App\Models;

use App\Interfaces\ITimeClock;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeClock
 *
 * @package App\Models
 */
class TimeClock extends Model implements ITimeClock
{
    protected $table = "timeclocks";

    protected $fillable = [];


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
     * @param Carbon $datetime
     *
     * @return mixed
     */
    public function setClockInTime(Carbon $datetime) : ITimeClock
    {
        return $this->setAttribute('clockin', $datetime);
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
}
