<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Services\Dashboard\Member\MemberService;
use App\Repository\TeamRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    private MemberService $memberService;
    private UserRepositoryInterface $userRepository;
    private TeamRepositoryInterface $teamRepository;

    public function __construct(MemberService $memberService , UserRepositoryInterface $userRepository , TeamRepositoryInterface $teamRepository){
        $this->memberService = $memberService;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->middleware('permission:members-read')->only('index' , 'show');
        $this->middleware('permission:members-create')->only('create' , 'store');
        $this->middleware('permission:members-update')->only('edit' , 'update' , 'toggleMember');
        $this->middleware('permission:members-delete')->only('destroy');
    }

    public function index(){
        $members = $this->userRepository->paginate(25);
        return view('dashboard.site.members.index' , [
            'members' => $members,
        ]);
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

    public function edit($id){
        $teams = $this->teamRepository->getAll(['id' , 'name_ar' , 'name_en']);
        $member = $this->userRepository->getById($id);
        return view('dashboard.site.members.edit' , [
           'member' =>  $member,'teams'=>$teams,
        ]);
    }


    public function update($id , MemberRequest $request){
        return $this->memberService->update($id , $request);
    }
    public function toggleMember(Request $request){
        return $this->memberService->toggleMember($request['id']);
    }
    public function destroy($id){
        return $this->memberService->delete($id);
    }
}
