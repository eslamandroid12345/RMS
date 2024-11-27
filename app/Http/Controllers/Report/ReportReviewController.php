<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportReviewRequest;
use App\Http\Services\Dashboard\Report\ReportReviewService;
use App\Repository\ReportReviewRepositoryInterface;

class ReportReviewController extends Controller
{
    private ReportReviewService $reportReviewService;
    private ReportReviewRepositoryInterface $reportReviewRepository;

    public function __construct(ReportReviewService $reportReviewService , ReportReviewRepositoryInterface $reportReviewRepository){
        $this->reportReviewService = $reportReviewService;
        $this->reportReviewRepository = $reportReviewRepository;
        $this->middleware('permission:reviews-create')->only('store');
    }

    public function store(ReportReviewRequest $request){
        return $this->reportReviewService->store($request);
    }
}
