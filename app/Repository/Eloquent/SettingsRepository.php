<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\SettingsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SettingsRepository extends Repository implements SettingsRepositoryInterface
{
protected Model  $model;
public function __construct(User $model)
{
    parent::__construct($model);
}
}
