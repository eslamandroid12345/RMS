<?php

namespace App\Http\Services\Dashboard\Report;

use App\Repository\ReportReviewRepositoryInterface;
use function App\store_model;

class ReportReviewService
{

    private ReportReviewRepositoryInterface $reportReviewRepository;

    public function __construct( ReportReviewRepositoryInterface $reportReviewRepository){
        $this->reportReviewRepository = $reportReviewRepository;
    }

    public function store($request){
        $data = $request->validated();
        $data['author_id'] = auth()->id();
        return store_model($this->reportReviewRepository , $data);
    }

}
