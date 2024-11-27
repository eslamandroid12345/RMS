<?php

namespace App\Http\Services\Api\Timesheet\Helpers;

use App\Http\Resources\TimeSheet\ActivityResource;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class DayActivityHelperService
{
    public function prepareDayActivity($groupedDayActivity)
    {
        $emptyActivityTemplate = $this->getEmptyActivityTemplate();
        $result = [];

        foreach ($groupedDayActivity as $hour => $activities) {
            $startTime = Carbon::parse(request('day') . "{$hour}:00:00");

            $result[$hour]['time'] = $startTime->format('h:i a') . ' - ' . $startTime->copy()->addHour()->format('h:i a');
            $result[$hour]['total_duration'] = $this->calculateTotalDuration($activities);
            for ($i = 0; $i < 6; $i++) {
                $endTime = $startTime->copy()->addMinutes(10);

                $activitiesInInterval = $this->getActivitiesInInterval($activities, $startTime, $endTime);
                $result[$hour]['activities'][] = $activitiesInInterval->isNotEmpty() ?
                    $this->formatActivity($activitiesInInterval->first(), $startTime, $endTime) :
                    $this->formatEmptyActivity($emptyActivityTemplate, $startTime, $endTime);

                $startTime->addMinutes(10);
            }
        }
        return array_values($result);
    }

    private function calculateTotalDuration($activities)
    {
        $totalDuration = CarbonInterval::seconds(0);

        foreach ($activities as $activity) {
            if ($activity->duration) {
                $totalDuration->add($activity->duration);
            }
        }

        return $totalDuration->cascade()->format('%H:%I:%S');
    }

    private function formatActivity($activity, Carbon $start, Carbon $end)
    {
        $activity->time = $this->formatTimeInterval($start, $end);
        return ActivityResource::make($activity);
    }

    private function formatEmptyActivity($template, Carbon $start, Carbon $end)
    {
        return array_merge(
            ['time' => $this->formatTimeInterval($start, $end)],
            $template
        );
    }

    private function formatTimeInterval(Carbon $start, Carbon $end)
    {
        return $start->format('h:i a') . ' - ' . $end->format('h:i a');
    }

    private function getActivitiesInInterval($activities, Carbon $start, Carbon $end)
    {
        return collect($activities)->filter(function ($activity) use ($start, $end) {
            $activityFrom = Carbon::parse($activity->from);
            return $activityFrom >= $start && $activityFrom < $end;
        });
    }

    private function getEmptyActivityTemplate()
    {
        return [
            'can_delete' => false,
            'screenshots' => __('messages.0 screenshots'),
            'activity' => __('messages.No Activity'),
        ];
    }
}
