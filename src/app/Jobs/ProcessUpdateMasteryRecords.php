<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class ProcessUpdateMasteryRecords implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $runId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Http::get(env('PY_API').'/update-mastery-records'.'?runId='.$this->runId);
    }
}
