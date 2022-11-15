<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aGolonganRepositoryImpl implements aGolonganRepositoryInterface
{
    public function addGolongan($request)
    {
        return  DB::connection('sqlsrv')->table("GolonganObat")->insert([ 
            'Golongan' => $request->Golongan 
        ]);
    }
    public function editGolongan($request)
    {

        $updateGolongan =  DB::connection('sqlsrv')->table('GolonganObat')
            ->where('ID', $request->ID)
            ->update([ 
                'Golongan' => $request->Golongan 
            ]);
        return $updateGolongan;
    }
    public function getGolonganbyId($id)
    {
        return  DB::connection('sqlsrv')
            ->table("GolonganObat")
            ->select(
                'ID',
                'Golongan' 
            )
            ->where('ID', $id)->get();
    }
    public function getGolonganbyName($name)
    {
        return  DB::connection('sqlsrv')
        ->table("GolonganObat")
        ->select(
            'Golongan'
        )
        ->where('Golongan', $name)->get();
    }
    public function getGolonganAll()
    {
        return  DB::connection('sqlsrv')
            ->table("GolonganObat")
            ->select(
                'ID',
                'Golongan' 
            )
            ->get();
    }
    public function getGolonganbyNameExceptId($request)
    {
        return  DB::connection('sqlsrv')
        ->table("GolonganObat")
        ->select(
            'ID',
            'Golongan'
        )
        ->where('ID','<>', $request->id)
        ->where('Golongan',$request->Golongan)
        ->get();
    }
}
