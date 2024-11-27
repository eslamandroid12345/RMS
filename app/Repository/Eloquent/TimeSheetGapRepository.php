<?php

namespace App\Repository\Eloquent;

use App\Models\TimeSheetGap;
use App\Repository\TimeSheetGapRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TimeSheetGapRepository extends Repository implements TimeSheetGapRepositoryInterface
{
    public function __construct(TimeSheetGap $model)
    {
        parent::__construct($model);
    }
}
