<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractualTeam extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'contractual_teams';

    public function projectEstimate()
    {
        return $this->belongsTo(ProjectEstimate::class,'project_estimate_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class,'team_id');
    }
}
