<?php

namespace App\Http\Services\Dashboard\Member;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Models\User;
use App\Repository\RoleRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class MemberService
{

    use Responser;
    private UserRepositoryInterface $userRepository;
    private FileManagerService $fileManager;
    private $roleRepository;
    public function __construct(UserRepositoryInterface $userRepository , FileManagerService $fileManager,RoleRepositoryInterface $roleRepository){
        $this->userRepository = $userRepository;
        $this->fileManager = $fileManager;
        $this->roleRepository=$roleRepository;
    }

    public function store($request){
        $data = $request->validated();
        $teams = $request['teams'];
        $role = $this->roleRepository->getById($request['role']);
        if($request->image !== null) {
            $data['image'] = $this->fileManager->handle('image', 'profiles/members/images');
        }
        DB::beginTransaction();
        $user = store_model($this->userRepository , $data , returnModel: true);
        $user->addRole('admin');
        $user->teams()->attach($teams);
        DB::commit();
        return redirect(route('members.index'))->with('success' , __("Added Successfully"));
    }

    public function update($id , $request){
        $data = $request->validated();
        $teams = $request['teams'];
        if($request->image !== null) {
            $data['image'] = $this->fileManager->handle('image', 'profiles/members/images');
        }
        DB::beginTransaction();
        $user=User::find($id);
        if ($request->password!=null){
            $data['password']=Hash::make($request->password);
        }else {
            $data['password']=$user->password;
        }
        $user = update_model($this->userRepository , $id , $data , returnModel: true);
        $user->teams()->sync($teams);
        DB::commit();
        return redirect(route('members.index'))->with('success' , __("Updated Successfully"));
    }

    public function toggleMember($id){
        return update_model($this->userRepository , $id , ['status' => !$this->userRepository->getById($id , ['id' , 'status'])->status] , 'members.index');
    }

    public function delete($id){
        return delete_model($this->userRepository , $id , ['image']);
    }




}
