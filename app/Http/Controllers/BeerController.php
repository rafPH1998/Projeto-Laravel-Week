<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeerRequest;
use App\Jobs\ExportJob;
use App\Jobs\SendExportEmailJob;
use App\Jobs\StoreExportDataJob;
use App\Services\PunkApiService;

class BeerController extends Controller
{

    public function __construct(protected PunkApiService $service)
    { }

    public function index(BeerRequest $request)
    {
        return $this->service
                    ->getBeers(...$request->validated());
    }

    public function export(BeerRequest $request)
    {
        $filename = 'cervejas-encontradas' . now()->format('Y-m-d - H_i') . '.xlsx';

        ExportJob::withChain([
            new SendExportEmailJob($filename),
            new StoreExportDataJob(auth()->user(), $filename)
        ])->dispatch($request->validated(), $filename);

        return 'criado';
    }
}
