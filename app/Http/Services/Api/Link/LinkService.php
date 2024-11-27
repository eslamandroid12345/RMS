<?php

namespace App\Http\Services\Api\Link;

use App\Http\Resources\Attachments\AttachmentResource;
use App\Http\Resources\Links\LinkResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Repository\AttachmentRepositoryInterface;
use App\Repository\LinkRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use function App\catchError;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class LinkService
{
    public function __construct(private LinkRepositoryInterface $linkRepository,private GetService $getService)
    {
    }

    public function show($id){
            return $this->getService->handle(LinkResource::class,$this->linkRepository,'getById',[$id],true);
    }
    public function store($request){
        try {
            DB::beginTransaction();
            $data=$request->validated();
            $data['created_by']=auth('api')->id();
            DB::commit();
            return store_model($this->linkRepository,$data,false);
        }catch (\Exception $e){
            DB::rollBack();
            return catchError($e);
        }
    }
    public function update($request){
        try {
            DB::beginTransaction();
            $data=$request->validated();
            $data['created_by']=auth('api')->id();
            DB::commit();
            return update_model($this->linkRepository,$data['id'],$data,false);
        }catch (\Exception $e){
            DB::rollBack();
            return catchError($e);
        }
    }
    public function destroy($id){
        return delete_model($this->linkRepository,$id);
    }
}
