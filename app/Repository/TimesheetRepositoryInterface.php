<?php

namespace App\Repository;

interface TimesheetRepositoryInterface extends RepositoryInterface
{
    public function getTimeSheetFiltered();

    public function getDayActivityFiltered();

}
