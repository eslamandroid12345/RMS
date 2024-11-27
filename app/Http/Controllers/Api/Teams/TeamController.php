<?php

namespace App\Http\Controllers\Api\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamRequest;
use App\Http\Resources\Teams\TeamResource;
use App\Http\Resources\Teams\TeamsResource;
use App\Http\Services\Api\Team\TeamService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\TeamRepositoryInterface;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private TeamService $teamService;
    private TeamRepositoryInterface $teamRepository;
    use Responser;
    public function __construct(TeamService $memberService , TeamRepositoryInterface $teamRepository,private GetService $getService){
        $this->teamService = $memberService;
        $this->teamRepository = $teamRepository;
        $this->middleware('permission:teams-read')->only('index' , 'show');
        $this->middleware('permission:teams-create')->only( 'store');
        $this->middleware('permission:teams-update')->only('update');
        $this->middleware('permission:teams-delete')->only('destroy');
    }

    public function index(){
        return $this->getService->handle(TeamsResource::class , $this->teamRepository);
    }

    public function store(TeamRequest $request){
        return $this->teamService->store($request);
    }

    public function show($id){
        return $this->getService->handle(TeamResource::class , $this->teamRepository, 'getById' , [$id] ,true);
    }

    public function update($id , TeamRequest $request){
        return $this->teamService->update($id , $request);
    }
    public function destroy($id){
        return $this->teamService->delete($id);
    }
    public function members(){
        return $this->teamService->members();
    }
}
