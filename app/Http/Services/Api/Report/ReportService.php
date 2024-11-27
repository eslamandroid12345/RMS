<?php

namespace App\Http\Services\Api\Report;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\ReportRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use function App\delete_model;
use function App\responseSuccess;
use function App\store_model;
use function App\update_model;

class ReportService
{

    use Responser;
    private ReportRepositoryInterface $reportRepository;
    private FileManagerService $fileManager;

    public function __construct(ReportRepositoryInterface $reportRepository , FileManagerService $fileManager){
        $this->reportRepository = $reportRepository;
        $this->fileManager = $fileManager;
    }



    public function store($request){
        $data = $request->validated();
        $data['author_id'] = auth('api')->id();
        $data['reciver_id']=$request->reciver_id;
         store_model($this->reportRepository , $data , 'reports.index');
        return responseSuccess(message: __('messages.Added Successfully'));
    }

    public function update($id , $request){
        $data = $request->validated();
        $teams = $request['teams'];
        if($request->image !== null) {
            $data['image'] = $this->fileManager->handle('image', 'profiles/members/images');
        }
        $user = update_model($this->userRepository , $id , $data , returnModel: true);
        $user->teams()->sync($teams);
        return redirect(route('members.index'))->with('success' , __("Updated Successfully"));
    }


    public function delete($id){
        return delete_model($this->reportRepository , $id , []);
    }




}
