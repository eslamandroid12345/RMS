<?php

namespace App\Repository;


interface ContractualTeamRepositoryInterface extends RepositoryInterface
{
    public function getAllTeamsForProject($id);
}
