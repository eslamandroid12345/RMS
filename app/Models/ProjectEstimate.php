<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEstimate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'project_estimates';

    public function scopes()
    {
        return $this->hasMany(ProjectEstimateScope::class,'project_estimate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function contractualTeams()
    {
        return $this->hasMany(ContractualTeam::class,'project_estimate_id');
    }
}
