<?php

namespace App\Repository;


interface UserRepositoryInterface extends RepositoryInterface {
    public function getMembers();
    public function getAdmins();

    public function users();
}
