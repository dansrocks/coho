<?php

namespace App\Helper;

/**
 * Class TimeDuration
 *
 * @package Illuminate\Support
 */
class TimeDuration
{
    /**
     * Returns a time periods (in second) as human readable format ( hours, minutes [, seconds]).
     *
     * @param  int $timeInSeconds
     *
     * @return bool
     */
    public static function showDurationHumanFriendly($timeInSeconds, $withSeconds = false)
    {
        $seconds = intval($timeInSeconds) % 60;
        $timeInMinutes = floor($timeInSeconds / 60);

        $minutes = ($timeInMinutes % 60);
        $timeInHours = floor($timeInMinutes / 60);

        $timeAsText = '';
        if ($timeInHours > 0 ) {
            $timeAsText .= sprintf(" %dh", $timeInHours);
        }

        if ($minutes > 0 ) {
            $timeAsText .= sprintf(" %dm", $minutes);
        }

        if ($withSeconds && $seconds > 0 ) {
            $timeAsText .= sprintf(" %ds", $seconds);
        }

        if (empty($timeAsText)) {
            $timeAsText = '--';
        }

        return $timeAsText;
    }
}
