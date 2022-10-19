<?php

namespace App\Http\Controllers;

use App\Services\PunkApiService;
use Illuminate\Http\Request;

class BeerController extends Controller
{

    public function __construct(protected PunkApiService $service)
    { }

    public function index(Request $request)
    {
        return $this->service
                    ->getBeers(...$request->all());
    }
}
