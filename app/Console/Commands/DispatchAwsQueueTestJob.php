<?php

namespace App\Console\Commands;

use App\Jobs\AwsQueueTest;
use App\Models\JobDependency;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:dispatch-job')]
#[Description('Dispatches an AwsQueueTest job')]
class DispatchAwsQueueTestJob extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $randomNumber = rand(1, 100);
        $jobDependency = new JobDependency;
        $jobDependency->some_number = $randomNumber;
        $jobDependency->save();

        AwsQueueTest::dispatch($jobDependency);

        $this->info('AwsQueueTest job dispatched.');
    }
}
