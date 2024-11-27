<?php

namespace App\Repository;

interface HolidayRepositoryInterface extends RepositoryInterface
{
    public function getPermissions();
    public function getSinglePermission($id);
}
