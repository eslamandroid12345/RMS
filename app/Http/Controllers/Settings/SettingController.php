<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\InfoSettingsRequest;
use App\Http\Services\Dashboard\Settings\SettingsService;
use App\Repository\SettingsRepositoryInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private SettingsRepositoryInterface $settingsRepository;
    private SettingsService $settingsService;
    public function __construct(SettingsRepositoryInterface $settingsRepository,SettingsService $settingsService){
            $this->settingsService=$settingsService;
            $this->settingsRepository=$settingsRepository;
//            $this->middleware('permission:members-update')->only('edit','update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function update(InfoSettingsRequest $request, string $id)
    {
        return $this->settingsService->update($id,$request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
