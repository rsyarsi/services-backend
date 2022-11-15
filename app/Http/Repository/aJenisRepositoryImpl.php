<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class aJenisRepositoryImpl implements aJenisRepositoryInterface
{
    public function addJenis($request)
    {
        return  DB::connection('sqlsrv')->table("ItemJenis")->insert([
            'NamaJenis' => $request->NamaJenis
        ]);
    }
    public function editJenis($request)
    {

        $updateJenis =  DB::connection('sqlsrv')->table('ItemJenis')
            ->where('ID', $request->ID)
            ->update([
                'NamaJenis' => $request->NamaJenis
            ]);
        return $updateJenis;
    }

    public function getJenisbyId($id)
    {
        return  DB::connection('sqlsrv')
            ->table("ItemJenis")
            ->select(
                'ID',
                'NamaJenis'
            )
            ->where('ID', $id)->get();
    }
    public function getJenisAll()
    {
        return  DB::connection('sqlsrv')
            ->table("ItemJenis")
            ->select(
                'ID',
                'NamaJenis'
            )
            ->get();
    }
    public function getJenisbyNameExceptId($request)
    {
        return  DB::connection('sqlsrv')
        ->table("ItemJenis")
        ->select(
            'ID',
            'NamaJenis'
        )
        ->where('NamaJenis', $request->NamaJenis)->get();
    }
    public function getJenisbyNameExceptIdById($request)
    {
        return  DB::connection('sqlsrv')
        ->table("ItemJenis")
        ->select(
            'ID',
            'NamaJenis'
        )
         ->where('ID', '<>',$request->ID)
         ->where('NamaJenis', $request->NamaJenis)
         ->get();
    }
}
