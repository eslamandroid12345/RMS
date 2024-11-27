<?php

namespace App\Http\Services\Api\Member;

use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Member\MemberStaticsResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Models\User;
use App\Repository\ReportRepositoryInterface;
use App\Repository\TaskMemberRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use function App\catchError;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class MemberService
{

    use Responser;
    private UserRepositoryInterface $userRepository;
    private FileManagerService $fileManager;
    private ReportRepositoryInterface $reportRepository;
    public function __construct(UserRepositoryInterface $userRepository , FileManagerService $fileManager,
                                ReportRepositoryInterface $reportRepository , private TaskMemberRepositoryInterface $taskMemberRepository){
        $this->userRepository = $userRepository;
        $this->fileManager = $fileManager;
        $this->reportRepository=$reportRepository;
    }
    public function show($id){

        $member = $this->userRepository->getById($id,relations:['permissions']);
        $member->waiting_reports=$this->reportRepository->countByStatus('WAITING_REPLY','author_id',$id);
        $member->viewed_reports=$this->reportRepository->countByStatus('RESPONDED','author_id',$id);
        $member->reports=$this->reportRepository->recentReports($id);
        $member->statics=$this->userRepository->getUserRatingStatics($id);
        return $this->responseSuccess(200,'Success',new MemberResource($member));
    }
    public function getMemberStatics($id){
        return $this->responseSuccess(200 , __('dashboard.Success') ,
            MemberStaticsResource::collection($this->taskMemberRepository->getMemberStatic($id)));
    }
    public function store($request){
        $data = $request->validated();
        $data['color']="rgb(". rand(0,255) .','.rand(0,255).','.rand(0,255).')';
        $teams = $request['teams'];
        $role = $request['role'];
        if($request->image !== null) {
            $data['image'] = $this->fileManager->handle('image', 'profiles/members/images');
        }
        DB::beginTransaction();
        $user = store_model($this->userRepository , $data , returnModel: true);
        $user->addRole($role);
        $user->permissions()?->attach($request['permissions']);
        $user->teams()?->attach($teams);
        DB::commit();
        return $this->responseSuccess(200,__('dashboard.Added_Successfully'));

    }

    public function update($id , $request){
        $data = $request->validated();
        $teams = $request['teams'];
        $role = $request['role'];
        DB::beginTransaction();
        try {
            $user=User::find($id);
            if($request->image !== null)
                $data['image'] = $this->fileManager->handle('image', 'profiles/members/images', $user->image);
            if ($request->password!=null)
                $data['password']=Hash::make($request->password);
            else
                $data['password']=$user->password;
            $user = update_model($this->userRepository , $id , $data , returnModel: true);
            $user->teams()->sync($teams);
            if($request['role']!=null)
                $user->syncRoles([$role]);
            if($request['permissions']!=null)
                $user->syncPermissions($request['permissions']);
            DB::commit();
            return $this->responseSuccess(200, __('dashboard.Updated_Successfully'), MemberResource::make($user));
        }catch (\Exception $e){
           return catchError($e);
        }

    }

    public function toggleMember($id){
        update_model($this->userRepository , $id , ['status' => !$this->userRepository->getById($id , ['id' , 'status'])->status]);
        return $this->responseSuccess(200,__('dashboard.Updated_Successfully'));
    }

    public function delete($id){
        delete_model($this->userRepository , $id , ['image']);
        return $this->responseSuccess(200,__('dashboard.Deleted_Successfully'));
    }




}
