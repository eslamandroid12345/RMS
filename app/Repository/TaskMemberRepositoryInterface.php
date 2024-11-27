<?php

namespace App\Repository;


interface TaskMemberRepositoryInterface extends RepositoryInterface {
    public function getMemberStatic($id);
}
