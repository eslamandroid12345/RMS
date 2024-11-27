<?php

namespace App\Http\Services\Api\Settings;

use App\Http\Services\Mutual\FileManagerService;
use App\Models\User;
use App\Repository\SettingsRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use function App\responseFail;
use function App\update_model;

class SettingsService
{
    private FileManagerService $fileManagerService;
    private SettingsRepositoryInterface $settingRepository;
    private UserRepositoryInterface $userRepository;
    public function __construct(FileManagerService $fileManagerService,SettingsRepositoryInterface $settingsRepository,UserRepositoryInterface $userRepository){
        $this->fileManagerService=$fileManagerService;
        $this->settingRepository=$settingsRepository;
        $this->userRepository=$userRepository;

    }
        public function update($id,$request){
            $data=$request->validated();
            if($request->image!==null){
                $data['image']=$this->fileManagerService->handle('image','profiles/members/images');
            }
            return update_model($this->settingRepository,$id,$data);
        }
        public function updatePassword($request){
//        if(!Hash::check($request['old_password'],auth('api')->user()->password)){
//            return responseFail(422,__('dashboard.Old_Password_Wrong'));
//        }
        return update_model($this->userRepository,auth()->id(),['password'=>Hash::make($request['new_password'])]);
        }
}
