<?php

namespace App\Http\Services\Api\Timesheet;

use App\Http\Resources\Image\ImageResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\TimesheetRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\responseFail;
use function App\responseSuccess;

abstract class TimesheetService
{
    public function __construct(
        private readonly TimesheetRepositoryInterface $repository,
        private readonly FileManagerService           $fileManagerService,
    )
    {

    }

    public function getImages($id)
    {
        DB::beginTransaction();
        try {
            $timesheet = $this->repository->getById($id, relations: ['images']);
            DB::commit();
            return responseSuccess(data: ImageResource::collection($timesheet->images));
        } catch (\Exception $e) {
            DB::rollBack();
//            return $e;
            return responseFail(message: __('Something Went Wrong'));
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $timesheet = $this->repository->create([
                'project_id' => $data['project_id'],
                'user_id' => auth('api')->id(),
                'from' => now(),
            ]);
            if ($request->gap_from !== null && $request->gap_to !== null)
                $this->attachGap($timesheet, $request);
            DB::commit();
            return responseSuccess(message: __('messages.Started Successfully'), data: [
                'id' => $timesheet->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseFail(message: __('Something Went Wrong'));
        }
    }

    private function attachGap($timesheet, $request)
    {
        $timesheet->gap()?->create([
            'from' => $request->gap_from,
            'to' => $request->gap_to,
        ]);
    }

    public function stop($id)
    {
        DB::beginTransaction();
        try {
            $timesheet = $this->repository->getById($id);
            if ($timesheet->to !== null)
                return responseFail(status: 403, message: __('messages.You Are Not Authorized For This Action'));
            $this->repository->update($id,
                ['to' => now()]
            );
            DB::commit();
            return responseSuccess(message: __('messages.Updated Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return responseFail(message: __('Something Went Wrong'));
        }
    }

    public function attachSession($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('screenshots');
            $session = $this->repository->create($data);
            if (!empty($request->screenshots))
                $this->fileManagerService->uploadMorphImages($request->screenshots, $session, 'screenshots');
            DB::commit();
            return responseSuccess(message: __('messages.Added Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
//            return $e;
            return responseFail(message: __('Something Went Wrong'));
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $timesheet = $this->repository->getById($id, relations: ['images']);
            $timesheet->images()?->delete();
            $timesheet->delete();
            DB::commit();
            return responseSuccess(message: __('messages.Deleted Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
//            return $e;
            return responseFail(message: __('Something Went Wrong'));
        }
    }
}
