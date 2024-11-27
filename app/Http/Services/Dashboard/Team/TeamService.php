<?php

namespace App\Http\Services\Dashboard\Team;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\TeamRepositoryInterface;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class TeamService
{

    use Responser;
    private TeamRepositoryInterface $teamRepository;
    private FileManagerService $fileManager;

    public function __construct(TeamRepositoryInterface $teamRepository , FileManagerService $fileManager){
        $this->teamRepository = $teamRepository;
        $this->fileManager = $fileManager;
    }

    public function store($request){
        $data = $request->validated();
        if($request->image !== null) {
            $data['icon'] = $this->fileManager->handle('image', 'teams/images');
        }
        return store_model($this->teamRepository , $data , 'teams.index');
    }

    public function update($id , $request){
        $data = $request->validated();
        if($request->image !== null) {
            $data['icon'] = $this->fileManager->handle('image', 'teams/images');
        }
        return update_model($this->teamRepository , $id , $data , 'teams.index');
    }

    public function delete($id){
        return delete_model($this->teamRepository , $id , ['icon']);
    }




}
