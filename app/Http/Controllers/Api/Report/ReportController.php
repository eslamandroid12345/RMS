<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportRequest;
use App\Http\Resources\Report\ReportResource;
use App\Http\Services\Api\Report\ReportService;
use App\Http\Services\Mutual\GetService;
use App\Repository\ReportRepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use function App\responseSuccess;

class ReportController extends Controller
{
    private ReportService $reportService;
    private ReportRepositoryInterface $reportRepository;

    public function __construct(ReportService $reportService , ReportRepositoryInterface $reportRepository ,protected GetService $get){
        $this->reportService = $reportService;
        $this->reportRepository = $reportRepository;
        $this->middleware('permission:reports-create')->only('store');
    }

    public function index(){
        return $this->get->handle(ReportResource::class , $this->reportRepository,  'getReports');
    }

    public function show($id){
        return $this->get->handle(ReportResource::class , $this->reportRepository , 'getReport' , [$id],true);
    }

    public function store(ReportRequest $request){
        return $this->reportService->store($request);
    }

    public function sendEmail(){
        Artisan::call('report-delay-email-send');
        return "done";
    }
}
