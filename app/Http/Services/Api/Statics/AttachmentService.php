<?php

namespace App\Http\Services\Api\Attachment;

use App\Http\Resources\Attachments\AttachmentResource;
use App\Http\Resources\Task\TaskResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Repository\AttachmentRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use function App\catchError;
use function App\delete_model;
use function App\responseSuccess;
use function App\store_model;
use function App\update_model;

class AttachmentService
{
    private AttachmentRepositoryInterface $attachmentRepository;
    public function __construct(private FileManagerService $fileManagerService,AttachmentRepositoryInterface $attachmentRepository,private GetService $getService)
    {
            $this->attachmentRepository=$attachmentRepository;
    }

    public function show($id){
            return $this->getService->handle(AttachmentResource::class,$this->attachmentRepository,'getById',[$id],true);
    }
    public function store($request){
        try {
            DB::beginTransaction();
            $data=$request->validated();
            $data['description']=$request->file('attachment')->getClientOriginalName();
            $data['path']=$this->fileManagerService->handle('attachment','projects/attachments');
            $data['type']=pathinfo($data['path'],PATHINFO_EXTENSION);
            $data=Arr::except($data,'attachment');
            $data['created_by']=auth('api')->id();
            DB::commit();
            $attachment=store_model($this->attachmentRepository,$data,true);
            return responseSuccess(message: __('messages.Added Successfully'),data: new AttachmentResource($attachment));

        }catch (\Exception $e){
            DB::rollBack();
            return catchError($e);
        }
    }
    public function update($request){
        try {
            DB::beginTransaction();
            $data=$request->validated();
            $data['description']=$request->file('attachment')->getClientOriginalName();
            $data['path']=$this->fileManagerService->handle('attachment','projects/attachments');
            $data['type']=pathinfo($data['path'],PATHINFO_EXTENSION);
            $data=Arr::except($data,'attachment');
            $data['created_by']=auth('api')->id();
            DB::commit();
            $attachment= update_model($this->attachmentRepository,$data['id'],$data,true);
            return responseSuccess(message: __('messages.Updated Successfully'),data: new AttachmentResource($attachment));
        }catch (\Exception $e){
            DB::rollBack();
            return catchError($e);
        }
    }
    public function destroy($id){
        return delete_model($this->attachmentRepository,$id,['path']);
    }
}
