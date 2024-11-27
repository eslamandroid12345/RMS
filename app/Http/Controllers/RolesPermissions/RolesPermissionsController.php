<?php

namespace App\Http\Controllers\RolesPermissions;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\RolePermission\RolePermissionService;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RolesPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private  $rolePermissionService;
    private  RoleRepositoryInterface $roleRepository;
    public function __construct(RolePermissionService $rolePermissionService,RoleRepositoryInterface $roleRepository){
            $this->rolePermissionService=$rolePermissionService;
            $this->roleRepository=$roleRepository;
    }
    public function index()
    {
        $roles=$this->rolePermissionService->index();
        return view('dashboard.site.roles.index',compact('roles'));
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
        $role=$this->roleRepository->getById($id);
        $permissions=$role->permissions()->pluck('name')->toArray();
        return view('dashboard.site.roles.edit',compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->rolePermissionService->update($id,$request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
