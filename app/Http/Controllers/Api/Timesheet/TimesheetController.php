<?php

namespace App\Http\Controllers\Api\Timesheet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timesheet\TimesheetRequest;
use App\Http\Requests\Timesheet\TimesheetSessionRequest;
use App\Http\Services\Api\Timesheet\TimesheetService;
 

class TimesheetController extends Controller
{
    public function __construct(
        private readonly TimesheetService $service
    )
    {

    }

    public function index()
    {
        return $this->service->index();
    }
    public function dayActivity()
    {
        return $this->service->dayActivity();
    }

    public function getImages($id)
    {
        return $this->service->getImages($id);
    }
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    public function store(TimesheetRequest $request)
    {
        return $this->service->store($request);
    }

    public function stop($id)
    {
        return $this->service->stop($id);
    }

    public function attachSession(TimesheetSessionRequest $request)
    {
        return $this->service->attachSession($request);
    }
}
