<?php

namespace App\Jobs;

use App\Models\JobDependency;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class AwsQueueTest implements ShouldQueue
{
    use Queueable;

    /**
     * @var int[]
     */
    public array $backoff = [1, 5, 10];

    protected JobDependency $jobDependency;

    /**
     * Create a new job instance.
     */
    public function __construct(JobDependency $jobDependency)
    {
        $this->jobDependency = $jobDependency;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('AWS Queue Test Job executed successfully. Number from job_dependency: '.$this->jobDependency->some_number);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        Log::error('AWS Queue Test Job failed.', [
            'job_dependency_id' => $this->jobDependency->id,
            'error' => $exception?->getMessage(),
        ]);
    }
}
