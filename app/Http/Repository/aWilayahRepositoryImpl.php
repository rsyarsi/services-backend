<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class aWilayahRepositoryImpl implements aWilayahRepositoryInterface
{ 
    public function Provinsi(){
        return  DB::connection('sqlsrv2')->table("MstrProvinsi")
        ->select(DB::raw("PovinsiID as ProvinsiID"),'ProvinsiNama') 
        ->orderBy('PovinsiID', 'asc')->get();
    }
    public function detailProvinsi($provinsiId){
        return  DB::connection('sqlsrv2')->table("MstrProvinsi")
        ->select(DB::raw("PovinsiID as ProvinsiID"),'ProvinsiNama') 
        ->where('PovinsiID',$provinsiId)->get();
    }
    public function Kabupaten($provinsiId){
        return  DB::connection('sqlsrv2')->table("MstrKabupaten")
        ->select('kabupatenId','kabupatenNama') 
        ->where('provinsiId',$provinsiId)
        ->orderBy('kabupatenId', 'asc')->get();
    }
    public function detailKabupaten($kabupatenId){
        return  DB::connection('sqlsrv2')->table("MstrKabupaten")
        ->select('kabupatenId','kabupatenNama') 
        ->where('kabupatenId',$kabupatenId)->get();
    }
    public function Kecamatan($kabupatenId){
        return  DB::connection('sqlsrv2')->table("mstrKecamatan")
        ->select('kecamatanId','Kecamatan') 
        ->where('kabupatenId',$kabupatenId)
        ->orderBy('kabupatenId', 'asc')->get();
    }
    public function detailKecamatan($kecamatanId){
        return  DB::connection('sqlsrv2')->table("mstrKecamatan")
        ->select('kecamatanId','Kecamatan') 
        ->where('kecamatanId',$kecamatanId)->get();
    }
    public function Kelurahan($kecamatanId){
        return  DB::connection('sqlsrv2')->table("mstrKelurahan")
        ->select('desaId','Kelurahan','kodepos') 
        ->where('kecamatanId',$kecamatanId)
        ->orderBy('desaId', 'asc')->get();
    }
    public function detailKelurahan($kelurahanId){
        return  DB::connection('sqlsrv2')->table("mstrKelurahan")
        ->select('desaId','Kelurahan','kodepos') 
        ->where('desaId',$kelurahanId)->get();
    }
}
