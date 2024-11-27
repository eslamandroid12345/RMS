<?php

namespace App\Http\Services\Api\Timesheet;

class TimesheetDesktopService extends TimesheetService
{
    public static function platform(): string
    {
        return 'desktop';
    }
}
