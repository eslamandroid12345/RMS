<?php

namespace App\Repository;


interface ReportRepositoryInterface extends RepositoryInterface {

    public function getReports();
    public function todayReports();
    public function recentReports();
    public function recievedReports($reports);
    public function veiwedReports($reports);
    }
