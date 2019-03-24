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
        $time = floor($timeInSeconds / 60);

        $minutes = ($time % 60);
        $time = floor($time / 60);

        $hours = floor($time / 60);

        $timeAsText = '';
        if ($hours > 0 ) {
            $timeAsText .= sprintf("%d h", $hours);
        }

        if ($minutes > 0 ) {
            $timeAsText .= sprintf("%d m", $minutes);
        }

        if ($withSeconds && $seconds > 0 ) {
            $timeAsText .= sprintf("%d s", $hours);
        }

        if (empty($timeAsText)) {
            $timeAsText = '0 s';
        }

        return $timeAsText;
    }
}
