<?php

namespace App\Http\Controllers;

use App\Events\BatchComplete;
use App\Jobs\GenerateReport;
use Illuminate\Bus\Batch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class GenerateReportController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {

        $jobs = [];

        for ($x = 0; $x <= 10; $x++) {
            $jobs[] = new GenerateReport($x);
        }

        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) {
                BatchComplete::dispatch($batch);
            })
            ->dispatch();

        return response()->json([
            'batchId' => $batch->id
        ]);
    }
}
