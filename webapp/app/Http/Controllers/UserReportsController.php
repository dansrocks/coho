<?php

namespace App\Http\Controllers;

use App\Managers\ClockTypesManager;
use App\Managers\UserReportsManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserReportsController
 *
 * @package App\Http\Controllers
 */
class UserReportsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Exception
     */
    public function showDailyReport()
    {
        /**
         *
         */
        $user = Auth::user();
        $today = new Carbon("today");
        $manager = new UserReportsManager($user);

        $timeClocks = $manager->getDailyReport($today);

        $content = [
            'today' => $today,
            'timeClocks' => $timeClocks,
        ];

        return view('users.reports.daily', $content);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Exception
     */
    public function showMonthlyReport()
    {
        $user = Auth::user();
        $from = new Carbon("first day of this month");
        $to = new Carbon("last day of this month");

        $manager = new UserReportsManager($user);
        $typesManager = new ClockTypesManager();

        $parsedData = $this->prepareMonthlyData(
            $from,
            $to,
            $manager->getClocksGroupedByType($from, $to)
        );

        $content = [
            'from' => $from,
            'to' => $to,
            'types' => $typesManager->getTypes(),
            'monthlyData' => $parsedData,
        ];

        return view('users.reports.monthly', $content);
    }

    /**
     * @param Carbon $from
     * @param Carbon $to
     * @param Collection $monthlyData
     *
     * @return array
     *
     * @throws \Exception
     */
    private function prepareMonthlyData(Carbon $from, Carbon $to, Collection $monthlyData): array
    {
        $parsedData = [];

        $iteratorDate = clone($from);
        while ($iteratorDate <= $to) {
            $parsedData[$iteratorDate->format('d')] = [
                'date' => clone($iteratorDate),
                'isWeekend' => $this->isWeekend($iteratorDate),
                'types' => [],
                'clocks' => 0,
                'duration' => 0,
            ];
            $iteratorDate->add(new \DateInterval("P1D"));
        }

        foreach ($monthlyData as $data) {
            $date = $data->getAttribute('date')->format('d');
            $type = $data->getAttribute('type');
            $clocks = $data->getAttribute('clocks');
            $duration = $data->getAttribute('duration');

            if (!isset($parsedData[$date]['types'][$type])) {
                $parsedData[$date]['types'][$type] = [
                    'clocks' => $clocks,
                    'duration' => $duration,
                ];
                $parsedData[$date]['clocks'] += $clocks;
                $parsedData[$date]['duration'] += $duration;
            }
        }
        return $parsedData;
    }


    /**
     * @param \DateTime $date
     *
     * @return bool
     */
    private function isWeekend(\DateTime $date)
    {
        $isWeekend = $date->format('N') >= 6;

        return $isWeekend;
    }
}
