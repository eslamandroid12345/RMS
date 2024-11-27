<?php

namespace App\Http\Services\Api\Timesheet;

use App\Http\Resources\TimeSheet\ActivityResource;
use App\Http\Resources\TimeSheet\TimeSheetResource;
use App\Http\Services\Api\Timesheet\Helpers\DayActivityHelperService;
use App\Http\Services\Api\Timesheet\Helpers\TimesheetHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\TimesheetRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use function App\responseSuccess;

class TimesheetWebsiteService extends TimesheetService
{
    public function __construct(
        private readonly TimesheetRepositoryInterface $repository,
        FileManagerService                            $fileManagerService,
        private readonly DayActivityHelperService     $dayActivityHelperService,
        private readonly TimesheetHelperService       $timesheetHelperService,
    )
    {
        parent::__construct($repository, $fileManagerService);
    }

    public static function platform(): string
    {
        return 'website';
    }

    public function index()
    {
        $timesheet = TimeSheetResource::collection($this->repository->getTimeSheetFiltered());
        $groupedTimesheet = $timesheet->groupBy(function ($date) {
            return Carbon::parse($date->from)->format('Y-m-d');
        });
        $data = $this->timesheetHelperService->calculateTotalDurationForDay($groupedTimesheet);
        return responseSuccess(data: $data);
    }


    public function dayActivity()
    {
        $dayActivity = $this->repository->getDayActivityFiltered();
        $groupedDayActivity = $dayActivity->groupBy(function ($date) {
            return Carbon::parse($date->from)->format('H');
        });
        $data = $this->dayActivityHelperService->prepareDayActivity($groupedDayActivity);
        return responseSuccess(data: $data);
    }


}
