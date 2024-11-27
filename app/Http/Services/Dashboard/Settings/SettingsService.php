<?php

namespace App\Http\Services\Dashboard\Settings;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\SettingsRepositoryInterface;
use function App\update_model;

class SettingsService
{
    private FileManagerService $fileManagerService;
    private SettingsRepositoryInterface $settingRepository;
    public function __construct(FileManagerService $fileManagerService,SettingsRepositoryInterface $settingsRepository){
        $this->fileManagerService=$fileManagerService;
        $this->settingRepository=$settingsRepository;

    }
public function update($id,$request){
    $data=$request->validated();
    if($request->image!==null){
        $data['image']=$this->fileManagerService->handle('image','profiles/members/images');
    }
    return update_model($this->settingRepository,$id,$data,true);
}
}
