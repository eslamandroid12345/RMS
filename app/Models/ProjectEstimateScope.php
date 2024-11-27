<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEstimateScope extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'project_estimate_scopes';

    public function projectEstimate()
    {
        return $this->belongsTo(ProjectEstimate::class,'project_estimate_id');
    }
}
