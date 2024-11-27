<?php

namespace App\Repository;


interface TaskRepositoryInterface extends RepositoryInterface
{

    public function prepareToDo();

    public function getToDo();
    public function countTasks($status);
}
