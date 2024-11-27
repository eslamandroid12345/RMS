<?php

namespace App\Http\Services\Dashboard\Panel;

use App\Repository\ReportRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class PanelService
{
    private $userRepository;
    private $reportRepository;
    public function __construct(UserRepositoryInterface $userRepository,ReportRepositoryInterface $reportRepository){
    $this->userRepository=$userRepository;
    $this->reportRepository=$reportRepository;
    }
    public function index(){
        $user=$this->userRepository->getById(auth()->id());
        $users=$this->userRepository->users();
        $reports=$this->reportRepository->todayReports();
        $recievedReports=$this->reportRepository->recievedReports($reports)->count();
        $veiwedReports=$this->reportRepository->veiwedReports($reports)->count();
        $recentReports=$this->reportRepository->recentReports();
        $teamStatus=[
            'labels'=>['OFFLINE','ONLINE','IN MEETING','OUT SICK','REMOTELY'],
            'values'=>[$users->where('current_status','OFFLINE')->count(),'value'=>$users->where('current_status','ONLINE')->count(),
                $users->where('current_status','IN MEETING')->count(),$users->where('current_status','OUT SICK')->count(),
                $users->where('current_status','REMOTELY')->count()],
            'colors'=>['red','blue','yellow','purple','orange']
        ];
//        $teamStatus=[
//            ['label'=>'OFFLINE','value'=>$users->where('current_status','OFFLINE')->count(),'color'=>'red'],
//            ['label'=>'ONLINE','value'=>$users->where('current_status','ONLINE')->count(),'color'=>'blue'],
//            ['label'=>'IN MEETING','value'=>$users->where('current_status','IN MEETING')->count(),'color'=>'yellow'],
//            ['label'=>'OUT SICK','value'=>$users->where('current_status','OUT SICK')->count(),'color'=>'purple'],
//            ['label'=>'REMOTELY','value'=>$users->where('current_status','REMOTELY')->count(),'color'=>],
//            ];
        return view('dashboard.site.home.index',compact('user','users',
            'reports','recievedReports','veiwedReports','recentReports','teamStatus'));
    }

}
