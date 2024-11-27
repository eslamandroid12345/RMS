<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Requests\Settings\InfoSettingsRequest;
use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Member\MemberSettingResource;
use App\Http\Services\Api\Settings\SettingsService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\SettingsRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    private SettingsRepositoryInterface $settingsRepository;
    private SettingsService $settingsService;
    private UserRepositoryInterface $userRepository;
    use Responser;
    public function __construct(SettingsRepositoryInterface $settingsRepository,SettingsService $settingsService,UserRepositoryInterface $userRepository,private GetService $getService){
            $this->settingsService=$settingsService;
            $this->settingsRepository=$settingsRepository;
            $this->userRepository=$userRepository;
//            $this->middleware('permission:members-update')->only('edit','update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->getService->handle(MemberSettingResource::class,$this->userRepository,'getById',[auth('api')->id()],true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->settingsRepository->getById($id);
        return view('dashboard.site.settings.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfoSettingsRequest $request)
    {
        return $this->settingsService->update(auth('api')->id(),$request);
    }
    public function updatePassword(UpdatePasswordRequest $request){
      return $this->settingsService->updatePassword($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
