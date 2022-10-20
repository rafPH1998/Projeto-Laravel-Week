<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{

    public function index()
    {
        $exports = Export::paginate(5);
    }

    public function destroy(Export $export)
    {
        $export = Export::find($export);

        if ($export) {
            Storage::delete($export->file_name);
            $export->delete();
        }
    }


}
