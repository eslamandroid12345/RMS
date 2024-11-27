<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\FileManager;
use App\Repository\RepositoryInterface;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    use FileManager;

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $columns = ['*'], array $relations = [], $orderBy = "ASC"): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function getActive(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->where('is_active' , true)->get($columns);
    }

    public function getById(
        $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }
// hedaaaa هيداااااااااا
    public function get(
        $byColumn,
        $value,
        array $columns = ['*'],
        array $relations = [],
    ): array|Collection
    {
        return $this->model::query()->select($columns)->with($relations)->where($byColumn, $value)->get();
    }

    public function first(
        $byColumn,
        $value,
        array $columns = ['*'],
        array $relations = [],
    ): Builder|Model
    {
        return $this->model::query()->select($columns)->with($relations)->where($byColumn, $value)->first();
    }

    public function getFirst(): ?Model {
        return $this->model->first();
    }

    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    public function insert(array $payload): bool
    {
        $model = $this->model::query()->insert($payload);

        return $model;
    }

    public function createMany(array $payload): bool
    {
        try {
            foreach ($payload as $record) {
                $this->model::query()->create($record);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update($modelId, array $payload): bool
    {
        $model = $this->getById($modelId);

        return $model->update($payload);
    }

    public function delete($modelId, array $filesFields = []): bool
    {
        $model = $this->getById($modelId);
        foreach ($filesFields as $field) {
            if ($model->$field !== null) {
                $this->deleteFile($model->$field);
            }
        }
        return $model->delete();
    }

    public function paginate(int $perPage = 10, array $relations = [] , $orderBy = 'ASC' , $columns = ['*'] , Closure $addition = null)
    {
        return $this->model::query()->select($columns)->with($relations)->where(function ($query) use ($addition) {
            if ($addition !== null && !(auth()->user()->hasRole(['admin']) || auth()->guard('api')->check())) {
                $addition($query);
            }})->orderBy('id' , $orderBy)->paginate($perPage);
    }

    public function whereHasMorph($relation, $class) {
        return $this->model::query()->whereHasMorph($relation, $class)->get();
    }
    public function countByStatus($status,string $columnForId=null,int $id=null,$date=null){
    return $this->model::query()->when($id,function ($query)use ($id,$columnForId){
        $query->where($columnForId,$id);
    })->where('status',$status)->when($date,function ($query) use($date){
        $query->whereDate('created_at',$date);
    })->count();
}
}
