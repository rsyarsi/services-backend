<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class aMasterUnitRepositoryImpl implements aMasterUnitRepositoryInterface
{
    public function getUnitById($id)
    {
        return  DB::connection('sqlsrv2')->table("MstrUnitPerwatan")
        ->where('ID', $id)
        ->get();
    }
    public function getUnitByIdBPJS($id)
    {
        return  DB::connection('sqlsrv2')->table("MstrUnitPerwatan")
        ->where('codeBPJS', $id)
        ->get();
    }
}