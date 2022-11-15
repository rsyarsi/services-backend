<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aSatuanRepositoryImpl implements aSatuanRepositoryInterface
{
    public function addSatuan($request)
    { 
        return  DB::connection('sqlsrv')->table("satuan")->insert([
            'isi' => $request->isi,
            'nama_satuan' => $request->nama_satuan
        ]); 
    }
    public function editSatuan($request)
    {
        $updatesatuan =  DB::connection('sqlsrv')->table('satuan')
        ->where('ID',$request->ID)
        ->update([
            'isi' => $request->isi,
            'nama_satuan' => $request->nama_satuan,
        ]);
        return $updatesatuan;
    }
   
    public function getSatuanbyId($id)
    {
        return  DB::connection('sqlsrv')->table("satuan")
        ->where('ID', $id)->get();
    }
    public function getSatuanAll(){
        return  DB::connection('sqlsrv')->table("satuan")->get();
    }
    public function getSatuanbyName($name)
    {
        return  DB::connection('sqlsrv')->table("satuan")
        ->where('nama_satuan', $name)->get();
    }
    public function getSatuanbyNameExceptId($request)
    {
        return  DB::connection('sqlsrv')->table("satuan")
        ->where('nama_satuan', $request['nama_satuan'])
        ->where('ID', '<>',$request['ID'])
        ->get();
    }
}
