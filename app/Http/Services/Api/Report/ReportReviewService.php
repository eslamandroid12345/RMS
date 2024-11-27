<?php

namespace App\Http\Services\Api\Report;

use App\Repository\ReportRepositoryInterface;
use App\Repository\ReportReviewRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use function App\delete_model;
use function App\responseFail;
use function App\store_model;

class ReportReviewService
{

    private ReportReviewRepositoryInterface $reportReviewRepository;

    public function __construct( ReportReviewRepositoryInterface $reportReviewRepository , protected ReportRepositoryInterface $reportRepository){
        $this->reportReviewRepository = $reportReviewRepository;
    }

    public function store($request){
        $report = $this->reportRepository->getById($request['report_id']);
        if (!Gate::allows('canReviewReport' , $report))
            return responseFail(403 , __('messages.You Are Not Authorized For This Action'));
        $data = $request->validated();
        $report=$this->reportRepository->getById($request['report_id']);
        $data['author_id'] = auth('api')->id();
        $data['reciver_id'] =$report->author_id ;
        $report->update(['status'=> 'RESPONDED']);
        return store_model($this->reportReviewRepository , $data);
    }


    public function delete($id){
        $review = $this->reportReviewRepository->getById($id);
        if ($review['author_id'] == auth()->id() || auth()->user()->hasPermission('reviews-delete'))
            return delete_model($this->reportReviewRepository , $id , []);
        return responseFail(403 , __('messages.You Are Not Authorized For This Action'));
    }

}
