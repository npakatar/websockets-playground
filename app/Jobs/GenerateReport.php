<?php

namespace App\Jobs;

use App\Events\ReportGenerated;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Batchable;

    public int $num;

    public function __construct(int $num)
    {
        $this->num = $num;
    }


    public function handle()
    {
        sleep(rand(10, 30));

        ReportGenerated::dispatch($this->batch());

        return;
    }
}
