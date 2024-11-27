<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportReviewRequest;
use App\Http\Services\Api\Report\ReportReviewService;
use App\Repository\ReportReviewRepositoryInterface;
use Illuminate\Http\Request;

class ReportReviewController extends Controller
{
    private ReportReviewService $reportReviewService;
    private ReportReviewRepositoryInterface $reportReviewRepository;

    public function __construct(ReportReviewService $reportReviewService , ReportReviewRepositoryInterface $reportReviewRepository){
        $this->reportReviewService = $reportReviewService;
        $this->reportReviewRepository = $reportReviewRepository;
    }

    public function store(ReportReviewRequest $request){
        return $this->reportReviewService->store($request);
    }

    public function destroy($id){
        return $this->reportReviewService->delete($id);

    }
}
