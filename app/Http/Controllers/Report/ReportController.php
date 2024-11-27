<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportRequest;
use App\Http\Services\Dashboard\Report\ReportService;
use App\Repository\ReportRepositoryInterface;
use App\Repository\TeamRepositoryInterface;
use Illuminate\Support\Facades\Artisan;

class ReportController extends Controller
{
    private ReportService $reportService;
    private ReportRepositoryInterface $reportRepository;
    private TeamRepositoryInterface $teamRepository;

    public function __construct(ReportService $reportService , ReportRepositoryInterface $reportRepository , TeamRepositoryInterface $teamRepository){
        $this->reportService = $reportService;
        $this->reportRepository = $reportRepository;
        $this->teamRepository = $teamRepository;
//        $this->middleware('permission:reports-read')->only('index' , 'show');
    }

    public function index(){
        $reports = $this->reportRepository->getReports();
        $teams = $this->teamRepository->getAll(['id' , 'name_ar' , 'name_en']);
        return view('dashboard.site.reports.index' , [
            'reports' => $reports,
            'teams' => $teams
        ]);
    }

    public function show($id){
        $report = $this->reportRepository->getById($id);
        $report->update(['status' => "VIEWED"]);
        return view('dashboard.site.reports.show' , [
            'report' => $report
        ]);
    }

    public function create(){
        return view('dashboard.site.reports.create');
    }

    public function store(ReportRequest $request){
        return $this->reportService->store($request);
    }

    public function sendEmail(){

        Artisan::call('report-delay-email-send');
        return "done";
    }
}
