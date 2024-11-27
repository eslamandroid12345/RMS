<?php

namespace App\Http\Services\Api\Timesheet\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class TimesheetHelperService
{

    public function calculateTotalDurationForDay(&$groupedTimesheet)
    {
        $result = [];
        foreach ($groupedTimesheet as $day => $timeSheets) {
            $totalDuration = CarbonInterval::seconds(0);
            foreach ($timeSheets as $timeSheet) {
                if ($timeSheet->duration !== null) {
                    $totalDuration->add($timeSheet->duration);
                }
            }
            $result[$day] = [
                'day' => Carbon::parse($day)->format('D, M d, Y'),
                'total_duration' => $totalDuration->cascade()->format('%H:%I:%S'),
                'time_sheets' => $timeSheets,
            ];
        }
        return array_values($result);
    }

}
