<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamRequest;
use App\Http\Resources\Teams\TeamsResource;
use App\Http\Services\Dashboard\Team\TeamService;
use App\Repository\TeamRepositoryInterface;

class TeamController extends Controller
{
    private TeamService $teamService;
    private TeamRepositoryInterface $teamRepository;

    public function __construct(TeamService $memberService , TeamRepositoryInterface $teamRepository){
        $this->teamService = $memberService;
        $this->teamRepository = $teamRepository;
        $this->middleware('permission:teams-read')->only('index' , 'show');
        $this->middleware('permission:teams-create')->only('create' , 'store');
        $this->middleware('permission:teams-update')->only('edit' , 'update');
        $this->middleware('permission:teams-delete')->only('destroy');
    }

    public function index(){
        return $this->getService->handle(TeamsResource::class,$this->teamRepository,'paginate',[25]);
    }

    public function store(TeamRequest $request){
        return $this->teamService->store($request);
    }

    public function edit($id){
        $team = $this->teamRepository->getById($id);
        return view('dashboard.site.teams.edit' , [
            'team' =>  $team
        ]);
    }

    public function update($id , TeamRequest $request){
        return $this->teamService->update($id , $request);
    }
    public function destroy($id){
        return $this->teamService->delete($id);
    }
}
