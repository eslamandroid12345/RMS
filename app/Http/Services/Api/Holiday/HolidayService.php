<?php

namespace App\Http\Services\Api\Holiday;

use App\Events\NewResponseEvent;
use App\Events\ResponsesClosedEvent;
use App\Http\Enums\HolidayStatus;
use App\Http\Resources\Holiday\HolidayDetailsResource;
use App\Http\Resources\Holiday\HolidayResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\HolidayRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use function App\responseFail;
use function App\responseSuccess;

class HolidayService
{
    public function __construct(
        private readonly HolidayRepositoryInterface $holidayRepository,
        private readonly GetService                 $get)
    {

    }

    public function index()
    {
        return $this->get->handle(HolidayResource::class, $this->holidayRepository
            , 'getPermissions');
    }

    public function show($id)
    {
        return $this->get->handle(HolidayDetailsResource::class, $this->holidayRepository
            , 'getSinglePermission', [$id], true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = array_merge($request->except('assignees'), [
                'status' => HolidayStatus::PENDING->value,
                'user_id' => auth('api')->id(),
            ]);
            $holiday = $this->holidayRepository->create($data);
            $this->assign(object: $holiday, assignees: array_merge($request->assignees, [auth('api')->id()]));
            DB::commit();
            return responseSuccess(message: __('messages.Added Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
//            return $e;
            return responseFail(message: __('Something Went Wrong'));
        }
    }

    public function storeResponse($request)
    {
        DB::beginTransaction();
        try {
            $holiday = $this->holidayRepository->getById($request->parent_id);
            if (!Gate::allows('response-permission', $holiday))
                return responseFail(403, __('messages.You Are Not Authorized For This Action'));
            if ($request->status !== null)
                $holiday->update(['status' => $request->status]);
            $data = array_merge($request->except('assignees'), ['user_id' => auth('api')->id()]);
            $response = $this->holidayRepository->create($data);
            $this->assign(object: $response, assignees: array_merge($request->assignees, [auth('api')->id()]));
            if ($request->status == HolidayStatus::APPROVED->value)
                broadcast(new NewResponseEvent($holiday->id, $response,array_merge($request->assignees, [auth('api')->id()]), 'CLOSE'))->toOthers();
            else
                broadcast(new NewResponseEvent($holiday->id, $response,array_merge($request->assignees, [auth('api')->id()])))->toOthers();
            DB::commit();
            return responseSuccess(message: __('messages.Added Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
//            return $e;
            return responseFail(message: __('Something Went Wrong'));
        }
    }

//    private function updateStatus($holiday, $status)
//    {
//        if ($status == HolidayStatus::APPROVED->value)
//            broadcast(new ResponsesClosedEvent($holiday->id));
//        $holiday->update(['status' => $status]);
//    }

    private function assign($object, $assignees)
    {
        $object->assignees()?->attach($assignees);
    }

}
