<?php

namespace App\Http\Controllers\Api\Members;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Requests\Report\ReportRequest;
use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Member\MembersResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\Api\Member\MemberService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use Responser;
    private MemberService $memberService;
    private UserRepositoryInterface $userRepository;
    private TeamRepositoryInterface $teamRepository;

    public function __construct(MemberService $memberService , UserRepositoryInterface $userRepository , TeamRepositoryInterface $teamRepository,private GetService $getService){
        $this->memberService = $memberService;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->middleware('permission:members-read')->only('index' , 'show');
        $this->middleware('permission:members-create')->only( 'store');
        $this->middleware('permission:members-update')->only('update' , 'toggleMember');
        $this->middleware('permission:members-delete')->only('destroy');
    }

    public function index(){
        return $this->getService->handle(MembersResource::class,$this->userRepository,'getMembers');
    }
    public function getAllMembers(){
        return $this->getService->handle(MembersResource::class,$this->userRepository,'getAllMembers');
    }
    public function admins(){
        return $this->getService->handle(MembersResource::class,$this->userRepository,'getAdmins');
    }
    public function show($id){
        return $this->memberService->show($id);
    }

    public function create(){
        $teams = $this->teamRepository->getAll(['id' , 'name_ar' , 'name_en']);
        return view('dashboard.site.members.create' , [
            'teams' => $teams
        ]);
    }

    public function store(MemberRequest $request){
        return $this->memberService->store($request);
    }


    public function update($id , MemberRequest $request){
        return $this->memberService->update($id , $request);
    }
    public function toggleMember($id){
        return $this->memberService->toggleMember($id);
    }
    public function destroy($id){
        return $this->memberService->delete($id);
    }
    public function getMemberStatics($id){
        return $this->memberService->getMemberStatics($id);
    }
}
