<?php

namespace App\Http\Controllers;

use App\Events\BatchComplete;
use App\Jobs\GenerateReport;
use Illuminate\Bus\Batch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Redirect;

class GenerateReportController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {

        $jobs = [];

        for ($x = 0; $x <= 10; $x++) {
            $jobs[] = new GenerateReport($x);
        }

        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) {
                event(new BatchComplete($batch));
            })
            ->dispatch();

        return Redirect::back()->with('message', 'Jobs processing');
    }
}
