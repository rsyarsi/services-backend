<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aKelompokRepositoryImpl implements aKelompokRepositoryInterface
{
    public function addKelompok($request)
    {
        return  DB::connection('sqlsrv')->table("ItemKelompok")->insert([
            'KelompokCode' => $request->KelompokCode,
            'KelompokName' => $request->KelompokName
        ]);
    }
    public function editKelompok($request)
    {

        $updateKelompok =  DB::connection('sqlsrv')->table('ItemKelompok')
            ->where('KelompokCode', $request->KelompokCode)
            ->update([
                'KelompokName' => $request->KelompokName
            ]);
        return $updateKelompok;
    }

    public function getKelompokbyId($id)
    {
        return  DB::connection('sqlsrv')
            ->table("ItemKelompok")
            ->select(
                'KelompokCode',
                'KelompokName'
            )
            ->where('KelompokCode', $id)->get();
    }
    public function getKelompokAll()
    {
        return  DB::connection('sqlsrv')
            ->table("ItemKelompok")
            ->select(
                'KelompokCode',
                'KelompokName'
            )
            ->get();
    }
    public function getKelompokbyName($request)
    {
        return  DB::connection('sqlsrv')
        ->table("ItemKelompok")
        ->select(
            'KelompokCode',
            'KelompokName'
        )
            ->where('KelompokName', $request->KelompokName)
            ->get();
    }
    public function getKelompokbyNameExceptId($request)
    {
        return  DB::connection('sqlsrv')
        ->table("ItemKelompok")
        ->select(
            'KelompokCode',
            'KelompokName'
        )
        ->where('KelompokCode','<>', $request->KelompokCode)
        ->where('KelompokName', $request->KelompokName)
        ->get();
    }
}
