<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use App\Http\Repository\aFormulariumRepositoryInterface;

class aFormulariumRepositoryImpl implements aFormulariumRepositoryInterface
{
    public function addFormularium($request)
    {
        return  DB::connection('sqlsrv')->table("TM_FORMULARIUM")->insert([
            'Nama_Formularium' => $request->Nama_Formularium
        ]);
    }
    public function editFormularium($request)
    {

        $updateFormularium =  DB::connection('sqlsrv')->table('TM_FORMULARIUM')
            ->where('ID', $request->ID)
            ->update([
                'Nama_Formularium' => $request->Nama_Formularium
            ]);
        return $updateFormularium;
    }

    public function getFormulariumbyId($id)
    {
        return  DB::connection('sqlsrv')
            ->table("TM_FORMULARIUM")
            ->select(
                'ID',
                'Nama_Formularium'
            )
            ->where('ID', $id)->get();
    }
    public function getFormulariumAll()
    {
        return  DB::connection('sqlsrv')
            ->table("TM_FORMULARIUM")
            ->select(
                'ID',
                'Nama_Formularium'
            )
            ->get();
    }
    public function getFormulariumbyName($request)
    {
        return  DB::connection('sqlsrv')
            ->table("TM_FORMULARIUM")
            ->select(
                'ID',
                'Nama_Formularium'
            )
            ->where('Nama_Formularium', $request->Nama_Formularium)
            ->get();
    }
    public function getFormulariumbyNameExceptId($request)
    {
        return  DB::connection('sqlsrv')
            ->table("TM_FORMULARIUM")
            ->select(
                'ID',
                'Nama_Formularium'
            )
            ->where('ID', '<>', $request->ID)
            ->where('Nama_Formularium', $request->Nama_Formularium)
            ->get();
    }
}
