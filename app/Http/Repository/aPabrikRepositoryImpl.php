<?php

namespace App\Http\Repository;
 
use Illuminate\Support\Facades\DB;

class aPabrikRepositoryImpl implements aPabrikRepositoryInterface
{
    public function addPabrik($request)
    {
        return  DB::connection('sqlsrv')->table("Pabrik")->insert([ 
            'Nama' => $request->Nama
        ]);
    }
    public function editPabrik($request)
    {

        $updatePabrik =  DB::connection('sqlsrv')->table('Pabrik')
            ->where('ID', $request->ID)
            ->update([ 
                'Nama' => $request->Nama
            ]);
        return $updatePabrik;
    }

    public function getPabrikbyId($id)
    {
        return  DB::connection('sqlsrv')
            ->table("Pabrik")
            ->select(
                'ID',
                'Nama'
            )
            ->where('ID', $id)->get();
    }
    public function getPabrikAll()
    {
        return  DB::connection('sqlsrv')
            ->table("Pabrik")
            ->select(
                'ID',
                'Nama'
            )
            ->get();
    }
    public function getPabrikbyName($request)
    {
        return  DB::connection('sqlsrv')
        ->table("Pabrik")
        ->select(
            'ID',
            'Nama'
        )
            ->where('Nama', $request->Nama)->get();
    }
    public function getPabrikbyNameExceptId($request)
    {
        return  DB::connection('sqlsrv')
        ->table("Pabrik")
        ->select(
            'ID',
            'Nama'
        )
        ->where('Nama', $request->Nama)
        ->where('ID','<>', $request->ID)
        ->get();
    }
}
