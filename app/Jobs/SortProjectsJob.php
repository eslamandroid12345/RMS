<?php

namespace App\Jobs;

use App\Repository\ProjectRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use mysql_xdevapi\Exception;
use function App\catchError;
use function App\update_model;

class SortProjectsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $projects;
    private $projectRepository;
    public function __construct($projects,$projectRepository)
    {
        $this->projects=$projects;
        $this->projectRepository=$projectRepository;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try
        {
            foreach ($this->projects['id'] as $k=> $id)
            {
                update_model($this->projectRepository,$id,['sort'=>$k],false);
            }
        }
        catch (Exception $e)
        {
            catchError($e);
        }
    }
}
